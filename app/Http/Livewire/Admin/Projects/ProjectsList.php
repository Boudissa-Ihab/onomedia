<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsList extends Component
{
    use WithPagination;

    protected $listeners = ['deleteRecords' => 'delete'];
    protected $paginationTheme = 'bootstrap';

    const FOLDER = "projects/";

    public function getProjectsProperty()
    {
        return Project::paginate(10);
    }

    public function delete($record)
    {
        try {
            DB::transaction(function () use ($record) {
                $project = Project::find($record);
                if(Storage::exists(self::FOLDER . $project->name))
                    Storage::deleteDirectory(self::FOLDER . $project->name);
                Project::destroy($record);
                $this->emit('showAlert', [
                    "title" => "Suppression réussie",
                    "text" => "Projet supprimé avec succès",
                    'icon' => "success"
                ]);
                return redirect()->route('admin.projects');
            });
        } catch (\Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec de la suppression",
                "text" => "Impossible de supprimer ce projet",
                'icon' => "warning"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.projects-list');
    }
}
