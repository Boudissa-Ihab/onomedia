<?php

namespace App\Http\Livewire\Client;

use App\Models\Project;
use Livewire\Component;

class ProjectsComponent extends Component
{
    public function getProjectsProperty()
    {
        return Project::limit(5)->get();
    }

    public function render()
    {
        return view('livewire.client.projects-component');
    }
}
