<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Throwable;

class EditProject extends Component
{
    use WithFileUploads;

    public Project $project;
    public $name;
    public $temporaryName;
    public $date;
    public $client;
    public $url;
    public $description;
    public $category;
    public $selectCategories = [];
    public $unselectCategories = [];
    public $photo;
    public $selectPhotos = [];
    const FOLDER = "projects/";

    protected $listeners = ['deleteRecords' => 'delete'];

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('App\Models\Project', 'name')->ignore($this->project->id)],
            'date' => 'required|date|before_or_equal:today',
            'client' => 'required|string',
            'url' => 'nullable|url',
            'description' => 'required|min:10',
            'selectCategories' => 'required|array',
            'selectCategories.*' => 'exists:App\Models\Category,id',
            'selectPhotos' => 'nullable|array',
            'selectPhotos.*' => 'required|image|mimes:jpeg,png,jpg,svg,webp,bmp|max:20000'
        ];
    }

    protected $messages = [
        'name.required' => "Le nom du projet ne peut pas être vide",
        'name.min' => "Le nom du projet doit contenir au moins 3 caractères",
        'name.unique' => "Le nom du projet doit être unique",
        'date.required' => "La date de finition doit être fournie",
        'date.date' => "La valeur fournie n'est pas une date valide",
        'date.before_or_equal' => "La date de finition ne peut pas dépasser la date d'aujourd'hui",
        'client.required' => "Le nom du client ne peut pas être vide",
        'url.url' => "Le lien du projet doit être de format valide",
        'description.required' => "Veuillez ajouter une petite description sur le projet",
        'description.min' => "La description doit contenir au moins 10 caractères",
        'selectCategories.required' => "Veuillez ajouter au moins une catégorie",
        'selectCategories.exists' => "Veuillez ajouter une catégorie valide",
        'selectPhotos.image' => "Le fichier doit être une image valide",
        'selectPhotos.mimes' => "L'extension de l'image doit être l'une des suivantes: .jpeg,.png,.jpg,.svg,.webp,.bmp",
        'selectPhotos.max' => "La taille de l'image ne doit pas dépasser 20 Mo"
    ];

    public function mount()
    {
        $this->name = $this->project->name;
        $this->temporaryName = $this->project->name;
        $this->date = $this->project->date;
        $this->client = $this->project->client;
        $this->url = $this->project->url;
        $this->description = $this->project->description;
        foreach($this->project->categories as $category)
            $this->selectCategories[$category->id] = $category->id;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function getCategoriesProperty()
    {
        $categories = Category::get();
        foreach($this->selectCategories as $category)
            $categories = $categories->except($category);
        return $categories;
    }

    public function updatedCategory($value)
    {
        if (in_array($value, $this->unselectCategories))
            unset($this->unselectCategories[$value]);

        if (($value) && !(in_array($value, $this->selectCategories)))
        {
            $this->selectCategories[$value] = $value;
            $this->categories = $this->categories->except($this->category);
        }
    }

    public function unsetCategory($id)
    {
        if(in_array($id, $this->selectCategories))
        {
            unset($this->selectCategories[$id]);
            $this->categories[] = Category::find($id);
        }

        if (!(in_array($id, $this->unselectCategories)))
            $this->unselectCategories[$id] = $id;
    }

    public function submit()
    {
        if($this->validate())
        {
            try{
                DB::transaction(function () {
                    $project = Project::find($this->project->id);
                    $project->name = $this->name;
                    $project->date = $this->date;
                    $project->client = $this->client;
                    $project->url = $this->url ?? null;
                    $project->description = $this->description;
                    // Rename folder with
                    if($project->isDirty('name'))
                        Storage::move(self::FOLDER . $this->temporaryName, self::FOLDER . $this->name);
                    $project->save();
                    $project->categories()->sync($this->selectCategories);
                    $this->emit('showAlert', [
                        "title" => "Action réussie",
                        "text" => "Projet modifié avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.projects');
                });
            } catch(Throwable $th) {
                dd($th);
                $this->emit('showAlert', [
                    "title" => "Echec de la modification",
                    "text" => "Impossible de modifier ce projet",
                    'icon' => "warning"
                ]);
            }
        }
    }

    /***** Slider management *****/

    public function getImagesProperty()
    {
        return $this->project->images;
    }

    public function delete($record)
    {
        try {
            $photo = $this->project->images()->find($record);
            if(Storage::exists(self::FOLDER . $this->project->name .'/'. $photo->url))
                Storage::delete(self::FOLDER . $this->project->name .'/'. $photo->url);
            $photo->delete();
            $this->emit('showAlert', [
                "title" => "Suppression réussie",
                "text" => "Slide supprimé avec succès",
                'icon' => "success"
            ]);
            return redirect()->route('admin.projects.edit', ['project' => $this->project->id]);
        } catch (Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec de la suppression",
                "text" => "Impossible de supprimet ce slide",
                'icon' => "warning"
            ]);
        }
    }

    public function updatedSelectPhotos()
    {
        if($this->validate())
        {
            try {
                foreach($this->selectPhotos as $photo)
                {
                    $webpPhoto = Image::make($photo)->encode('webp');
                    $storeImage = Storage::put(self::FOLDER . $this->project->name .'/'. $webpPhoto->filename. '.webp', $webpPhoto->__toString());
                    if($storeImage)
                    {
                        $projectImage = new ProjectImages();
                        $projectImage->url = $webpPhoto->filename. '.webp';
                        $this->project->images()->save($projectImage);
                    }
                }
                $this->emit('showAlert', [
                    "title" => "Ajout réussi",
                    "text" => "Slides ajoutés avec succès",
                    'icon' => "success"
                ]);
                return redirect()->route('admin.projects.edit', ['project' => $this->project->id]);

            } catch(Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de l'ajout",
                    "text" => "Impossible d'ajouter ces slides",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.edit-project');
    }
}
