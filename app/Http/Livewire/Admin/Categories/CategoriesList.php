<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class CategoriesList extends Component
{
    use WithPagination;

    public $category;
    public $name;

    protected $listeners = ['deleteRecords' => 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return [
            'name' => ['required', 'string']
        ];
    }

    public function getCategoriesProperty()
    {
        return Category::withCount('projects')->paginate(10);
    }

    public function delete($record)
    {
        try {
            DB::transaction(function () use ($record) {
                Category::destroy($record);
                $this->emit('showAlert', [
                    "title" => "Suppression réussie",
                    "text" => "Catégorie supprimée avec succès",
                    'icon' => "success"
                ]);
                return redirect()->route('admin.categories');
            });
        } catch (\Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec de la suppression",
                "text" => "Impossible de supprimer cette catégorie",
                'icon' => "warning"
            ]);
        }
    }

    public function setCategory($id)
    {
        try{
            $category = Category::find($id);
            $this->category = $category;
            $this->name = $this->category->name;
        } catch(Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec",
                "text" => "Impossible de trouver cette catégorie",
                'icon' => "error"
            ]);
        }
    }

    public function submit()
    {
        if($this->validate())
        {
            try{
                $this->category->name = $this->name;
                $this->category->save();
                $this->emit('showAlert', [
                    "title" => "Modification réussie",
                    "text" => "Catégorie modifiée avec succès",
                    'icon' => "success"
                ]);
                return redirect()->route('admin.categories');
            } catch(Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec",
                    "text" => "Impossible de modifier cette catégorie",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-list');
    }
}
