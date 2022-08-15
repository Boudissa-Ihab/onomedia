<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::guard('admin')->attempt($credentials, $this->remember))
            return redirect()->route('admin.dashboard');

        else
            session()->flash("error", "Adresse mail et/ou mot de passe erroné(s)");
    }

    public function render()
    {
        return view('livewire.admin.login')->layout('layouts.auth');
    }
}
