<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class AddCategoryModal extends Component
{
    public $name;

    public function rules()
    {
        return [
            'name' => ['required', 'string']
        ];
    }

    protected $messages = [
        'name.required' => "La catégorie ne peut pas être vide"
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function submit()
    {
        if($this->validate())
        {
            try{
                DB::transaction(function () {
                    Category::create([
                        'name' => $this->name
                    ]);
                    $this->emit('showAlert', [
                        "title" => "Ajout réussi",
                        "text" => "Catégorie ajoutée avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.categories');
                });
            } catch(Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de l'ajout",
                    "text" => "Impossible d'ajouter cette catégorie",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.add-category-modal');
    }
}
