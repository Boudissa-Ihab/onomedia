<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class AddProject extends Component
{
    public $name;
    public $date;
    public $client;
    public $url;
    public $description;
    public $category;
    public $selectCategories = [];
    public $unselectCategories = [];

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:projects,name',
            'date' => 'required|date|before_or_equal:today',
            'client' => 'required|string',
            'url' => 'nullable|url',
            'description' => 'required|min:10',
            'selectCategories' => 'required|array',
            'selectCategories.*' => 'exists:App\Models\Category,id'
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
        'selectCategories.exists' => "Veuillez ajouter une catégorie valide"
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function getCategoriesProperty()
    {
        return Category::get();
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
                    $project = new Project();
                    $project->name = $this->name;
                    $project->date = $this->date;
                    $project->client = $this->client;
                    $project->url = $this->url ?? null;
                    $project->description = $this->description;
                    $project->save();
                    $project->categories()->attach($this->selectCategories);
                    $this->emit('showAlert', [
                        "title" => "Ajout réussi",
                        "text" => "Projet ajouté avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.projects');
                });
            } catch(Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de l'ajout",
                    "text" => "Impossible d'ajouter ce projet",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.add-project');
    }
}
