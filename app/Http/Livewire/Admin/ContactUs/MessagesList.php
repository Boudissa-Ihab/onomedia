<?php

namespace App\Http\Livewire\Admin\ContactUs;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function getMessagesProperty()
    {
        return ContactUs::orderBy('read_at')
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function goToDetails($id)
    {
        $message = ContactUs::find($id);
        $message->read_at = now();
        $message->save();
        return to_route('admin.messages.message-details', ['message' => $id]);
    }

    public function render()
    {
        return view('livewire.admin.contact-us.messages-list');
    }
}
