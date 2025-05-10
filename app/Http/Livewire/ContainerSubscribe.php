<?php

namespace App\Http\Livewire;

use App\Models\Newsletter;
use Livewire\Component;

class ContainerSubscribe extends Component
{
    public $email;

    public function subscribe()
    {
        // Debugging log to check if the function is being accessed
        logger('Function subscribe is being accessed');

        $this->validate([
            'email' => 'required|email|unique:newsletters',
        ]);

        $newsletter = new Newsletter;
        $newsletter->email = $this->email;
        $newsletter->save(); // Corrected line
        session()->flash('success', 'Thank you for subscribing!');

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.container-subscribe');
    }
}