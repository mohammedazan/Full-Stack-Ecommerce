<?php

namespace App\Http\Livewire;

use App\Models\Newsletter;
use Livewire\Component;

class ContainerSubscribe extends Component
{
    public $email;

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:newsletters',
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $this->email;
        $newsletter->save();

        session()->flash('success', 'Thank you for subscribing!');
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.container-subscribe');
    }
}
