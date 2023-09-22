<?php

namespace App\Livewire;

use Livewire\Component;

class Intent extends Component
{
    public $intentClientSecret;

    /**
     *  load Intent Client Secret for purchase
     */
    public function loadIntentClientSecret()
    {
        $intent = auth()->user()->createSetupIntent();
        $this->intentClientSecret = $intent->client_secret;
    }

    public function render()
    {
        return view('livewire.intent');
    }
}
