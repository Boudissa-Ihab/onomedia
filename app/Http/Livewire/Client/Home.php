<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class Home extends Component
{
    public function getCategoriesProperty()
    {
        return Category::get();
    }

    public function getProjectsProperty()
    {
        return Project::with('categories')->get();
    }

    /*** Contact us ***/
    public $name;
    public $email;
    public $subject;
    public $message;

    public function rules()
    {
        return [
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ];
    }

    protected $messages = [
        'email.required' => "L'adresse mail ne peut pas être vide",
        'email.email' => "Veuillez entrer une adresse mail valide",
        'subject.required' => "Le sujet du message ne peut pas être vide",
        'message.required' => "Le contenu du message ne peut pas être vide"
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function send()
    {
        if ($this->validate()) {
            try {
                DB::transaction(function () {
                    ContactUs::create([
                        'name' => $this->name ?? "",
                        'email' => $this->email,
                        'subject' => $this->subject,
                        'message' => $this->message,
                        'read_at' => null
                    ]);
                    session()->flash("success", "Message envoyé avec succès !");
                });
            } catch (Throwable $e) {
                session()->flash("error", "Impossible d'envoyer ce message, veuillez réessayer");
            }
        }
        else
            session()->flash("error", "Veuillez remplir les informations nécessaires");
    }
    /*** Contact us ***/

    public function render()
    {
        return view('livewire.client.home')->layout('layouts.client');
    }
}
