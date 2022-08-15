<?php

namespace App\Http\Livewire\Admin\ContactUs;

use App\Models\ContactUs;
use Livewire\Component;
use Throwable;

class NavBarComponent extends Component
{
    protected $listeners = ['readMessage'];

    public function getMessagesProperty()
    {
        return ContactUs::where('read_at', null)->orderByDesc('created_at')->take(5)->get();
    }

    public function readMessage($id)
    {
        try {
            $message = ContactUs::find($id);
            $message->read_at = now();
            $message->save();
        } catch(Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec",
                "text" => "Impossible de voir ce message, il se peut qu'il a été supprimé ou une erreur est survenue",
                'icon' => "warning"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.contact-us.nav-bar-component');
    }
}
