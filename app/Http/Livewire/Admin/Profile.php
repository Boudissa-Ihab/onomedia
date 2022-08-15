<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Throwable;

class Profile extends Component
{
    use WithFileUploads;

    public $admin;
    public $name;
    public $email;
    public $phone;
    public $old_password;
    public $password;
    public $password_confirmation;
    public $avatar;
    const FOLDER = "admins/";

    protected $messages = [
        'name.required' => "Le nom ne peut pas être vide",
        'email.required' => "L'adresse mail ne peut pas être vide",
        'email.email' => "Veuillez entrer une adresse mail valide",
        'email.unique' => "Cette adresse mail est déjà utilisée",
        'phone.required' => "Un numéro de téléphone doit être fourni",
        'phone.unique' => "Ce numéro de téléphone est déjà utilisé",
        'old_password.required' => "Votre ancien mot de passe doit être rempli",
        'old_password.current_password' => "Mot de passe incorrect, veuillez réessayer",
        'password.required' => "Un nouveau mot de passe doit être fourni",
        'password.min' => "Le nouveau mot de passe doit contenir au moins 8 caractères",
        'password.confirmed' => "Veuillez ressaisir le nouveau mot de passe",
        'password.different' => "Le nouveau mot de passe doit être différent du mot de passe courant",
        'password_confirmation.same' => "Le mot de passe et sa confirmation ne sont pas identiques"
    ];

    public function mount()
    {
        $this->admin = auth()->user();
        $this->name = $this->admin->name;
        $this->email = $this->admin->email;
        $this->phone = $this->admin->phone;
    }

    public function editInfo()
    {
        if ($this->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('App\Models\Admin', 'email')->ignore($this->admin->id)],
            'phone' => ['required', Rule::unique('App\Models\Admin', 'phone')->ignore($this->admin->id)],
        ])) {
            try {
                DB::transaction(function () {
                    $this->admin->update([
                        'name' => $this->name ?? $this->admin->name,
                        'email' => $this->email ?? $this->admin->email,
                        'phone' => $this->phone ?? $this->admin->phone
                    ]);
                    $this->emit('showAlert', [
                        "title" => "Action réussie",
                        "text" => "Informations modifiées avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.profile');
                });
            } catch (Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de la modification",
                    "text" => "Impossible de modifier les informations",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function resetPassword()
    {
        if ($this->validate([
            'old_password' => ['current_password:admin', 'required'],
            'password' => 'required|string|min:8|confirmed|different:old_password',
            'password_confirmation' => 'same:password'
        ])) {
            try {
                DB::transaction(function () {
                    $this->admin->update([
                        'password' => Hash::make($this->password) ?? $this->admin->password
                    ]);
                    $this->emit('showAlert', [
                        "title" => "Action réussie",
                        "text" => "Informations modifiées avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.profile');
                });
            } catch (Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de la modification",
                    "text" => "Impossible de modifier les informations",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function updatedAvatar()
    {
        if($this->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg,webp,bmp|max:2048'
        ]))
        {
            try {
                // If admin has an avatar, delete it from storage
                if($this->admin->avatar)
                    Storage::delete(self::FOLDER . $this->admin->avatar. '.webp');

                $webpImage = Image::make($this->avatar)->resize(126, 126)->encode('webp');
                // Store the image in "storage/app/public/profiles"
                $storeImage = Storage::put(self::FOLDER .$this->admin->name. '.webp', $webpImage->__toString());
                if($storeImage)
                {
                    $this->admin->avatar = $this->admin->name. '.webp';
                    $this->admin->save();
                    $this->emit('showAlert', [
                        "title" => "Action réussie",
                        "text" => "Image ajoutée avec succès",
                        'icon' => "success"
                    ]);
                    return redirect()->route('admin.profile');
                }
                else
                    $this->emit('showAlert', [
                        "title" => "Echec de l'enregistrement de l'image",
                        "text" => "Une erreur est survenue durant le stockage de l'image, veuillez réessayer",
                        'icon' => "warning"
                    ]);

            } catch (Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Echec de la modification",
                    "text" => "Impossible d'ajouter cette image",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
