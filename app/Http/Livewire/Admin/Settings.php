<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Throwable;

class Settings extends Component
{
    use WithFileUploads;

    public $app_name;
    public $phone;
    public $email;
    public $address;
    public $description;
    public $logo;
    public $facebook_link;
    public $instagram_link;
    public $availability;
    public $temporaryLogo;
    const FOLDER = "logo/";

    public function mount()
    {
        $this->app_name = setting('app_name') ?? "Ono Design";
        $this->phone = setting('phone') ?? "";
        $this->email = setting('email') ?? "";
        $this->address = setting('address') ?? "";
        $this->description = setting('description') ?? "";
        $this->facebook_link = setting('facebook_link') ?? "";
        $this->instagram_link = setting('instagram_link') ?? "";
        $this->temporaryLogo = setting('logo');
        // Availability key/value pair for opening/closing schedule
        // where key : days of work / value : an array of 2 values
        // first value is opening time, second value is closing time
        if(setting('availability'))
        {
            foreach(setting('availability') as $key => $value)
                $this->availability[$key] = $value;
        } else {
            $this->availability = [
                'Samedi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Dimanche' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Lundi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Mardi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Mercredi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Jeudi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ],
                'Vendredi' => [
                    "opening_time" => "08:00",
                    "closing_time" => "16:00"
                ]
            ];
        }
    }

    public function save()
    {
        try {
            setting([
                'app_name' => $this->app_name ?? "",
                'phone' => $this->phone ?? "",
                'email' => $this->email ?? "",
                'address' => $this->address ?? "",
                'description' => $this->description ?? "",
                'facebook_link' => $this->facebook_link ?? "",
                'instagram_link' => $this->instagram_link ?? "",
                'availability' => $this->availability ?? null
            ]);
            setting()->save();

            $this->emit('showAlert', [
                "title" => "Action réussie",
                "text" => "Paramètres enregistrés avec succès",
                'icon' => "success"
            ]);
            return redirect()->route('admin.settings');
        } catch(Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Action échouée",
                "text" => "Une erreur est survenue lors de l'enregistrement des paramètres",
                'icon' => "warning"
            ]);
        }
    }

    public function updatedLogo()
    {
        if($this->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg,webp,bmp|max:50000'
        ]))
        {
            try {
                if($this->logo)
                {
                    $webpImage = Image::make($this->logo)->encode('webp');
                    $storeImage = Storage::put(self::FOLDER ."Logo.webp", $webpImage->__toString());
                    if($storeImage)
                    {
                        setting(['logo' => "Logo.webp"])->save();
                        $this->emit('showAlert', [
                            "title" => "Action réussie",
                            "text" => "Logo enregistré avec succès",
                            'icon' => "success"
                        ]);
                        return redirect()->route('admin.settings');
                    }
                }
                else
                    $this->emit('showAlert', [
                        "title" => "Action échouée",
                        "text" => "Une erreur est survenue durant le stockage du logo, veuillez réessayer",
                        'icon' => "warning"
                    ]);
            } catch (Throwable $th) {
                $this->emit('showAlert', [
                    "title" => "Erreur",
                    "text" => "Impossible d'ajouter le logo pour le moment",
                    'icon' => "warning"
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
