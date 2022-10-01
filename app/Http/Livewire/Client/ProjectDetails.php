<?php

namespace App\Http\Livewire\Client;

use App\Models\Project;
use Livewire\Component;

class ProjectDetails extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.client.project-details')->layout('layouts.project');
    }
}
