<?php

namespace App\Livewire;

use Livewire\Component;

class PageA extends Component
{
    public $data = "This is the data from Page A!";

    public function transferData()
    {
        $this->dispatch('page-b', 'receiveData', $this->data);
    }

    public function render()
    {
        return view('livewire.page-a');
    }

}
