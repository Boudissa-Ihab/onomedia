<?php

namespace App\Http\Livewire\Admin\ContactUs;

use App\Models\ContactUs;
use Livewire\Component;

class MessageDetails extends Component
{
    public ContactUs $message;

    public function render()
    {
        return view('livewire.admin.contact-us.message-details');
    }
}
