<?php

namespace App\Http\Livewire\Admin\ContactUs;

use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MessagesList extends Component
{
    use WithPagination;
    protected $listeners = ['deleteRecords' => 'delete'];
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

    public function delete($record)
    {
        try {
            DB::transaction(function () use ($record) {
                ContactUs::destroy($record);
                $this->emit('showAlert', [
                    "title" => "Suppression réussie",
                    "text" => "Message supprimé avec succès",
                    'icon' => "success"
                ]);
                return redirect()->route('admin.messages');
            });
        } catch (\Throwable $th) {
            $this->emit('showAlert', [
                "title" => "Echec de la suppression",
                "text" => "Impossible de supprimer ce message",
                'icon' => "warning"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.contact-us.messages-list');
    }
}
