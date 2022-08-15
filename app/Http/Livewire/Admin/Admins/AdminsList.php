<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminsList extends Component
{
    use WithPagination;

    protected $listeners = ['deleteRecords' => 'delete'];
    protected $paginationTheme = 'bootstrap';

    public function getAdminsProperty()
    {
        return Admin::paginate(10);
    }

    public function delete($record)
    {
        try {
            DB::transaction(function () use ($record) {
                Admin::destroy($record);
                $this->emit('showAlert', [
                    "title" => "Suppression réussie",
                    "text" => "Administrateur supprimé avec succès",
                    'icon' => "success"
                ]);
            });
        } catch (\Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec de la suppression",
                "text" => "Impossible de supprimer cet administrateur",
                'icon' => "warning"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.admins.admins-list');
    }
}
