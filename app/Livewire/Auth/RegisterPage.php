<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;


#[Title('Register')]

class RegisterPage extends Component
{

    public $name;
    public $email;
    public $password;

    // register user
    public function save() {
        // dd($this->email, $this->name, $this->password);

        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255',
        ]);

        // store to database
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        // login user
        auth()->login($user);

        // redirect to home page

        return redirect()->intended();

    }

    public function users() {

    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
