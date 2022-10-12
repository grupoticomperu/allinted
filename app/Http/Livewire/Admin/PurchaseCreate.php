<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PurchaseCreate extends Component
{
    public $cart=[], $total=[];
    public function render()
    {
        return view('livewire.admin.purchase-create');
    }
}
