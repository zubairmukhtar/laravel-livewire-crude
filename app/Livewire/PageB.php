<?php

namespace App\Livewire;

use Livewire\Component;

class PageB extends Component
{
    public $receivedMessage;

    protected $listeners = ['receiveData' => 'handleReceivedData'];

    public function handleReceivedData($data)
    {
        // Storing the received data
        $this->receivedMessage = $data;
    }

    public function render()
    {
        return view('livewire.page-b');
    }
}
