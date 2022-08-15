<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;

class AddAdmin extends Component
{
    public $name;
    public $email;
    public $phone;
    public $password;
    public $password_confirmation;


    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => 'required|email|unique:App\Models\Admin,email',
            'phone' => ['required', 'unique:admins,phone'],
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    protected $messages = [
        'name.required' => "Nom de l'administrateur ne peut pas être vide",
        'email.required' => "L'adresse mail ne peut pas être vide",
        'email.email' => "Veuillez entrer une adresse mail valide",
        'email.unique' => "Cette adresse mail est déjà utilisée",
        'phone.required' => "Un numéro de téléphone doit être fourni",
        'phone.unique' => "Ce numéro de téléphone est déjà utilisé",
        'password.required' => "Un mot de passe doit être fourni",
        'password.min' => "Le mot de passe doit contenir au moins 8 caractères",
        'password.confirmed' => "Veuillez ressaisir le mot de passe"
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
                    Admin::create([
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'password' => Hash::make($this->password)
                    ]);
                    $this->emit('showAlert', [
                        "title" => "Ajout réussi",
                        "text" => "Administrateur ajouté avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.admins');
                });
            } catch(Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de l'ajout",
                    "text" => "Impossible d'ajouter cet administrateur",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.admins.add-admin');
    }
}
