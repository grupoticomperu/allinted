<?php

namespace App\Http\Livewire\Admin;

use App\Models\Um;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UmCreate extends Component
{

    use WithFileUploads;
    public $open = false;
    public $name, $state, $abbreviation;

    public function nuevo(){
        $this->open = true;
    }

    protected $rules = [
        'name'=> 'required|unique:brands',
        'abbreviation'=>'',
        'state'=>''
    ];


    public function save(){

        $this->validate();
        //dd($this->state);
        $statee = ($this->state) ? 1 : 0 ;


        Um::create([
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'slug' => Str::slug($this->name),
            'state' => $statee,
        ]);

        $this->reset(['open','name']);

        $this->emitTo('admin.um-list','render');

        $this->emit('alert','La Unidad de medida se creo correctamente');
    }




    public function render()
    {
        return view('livewire.admin.um-create');
    }
}
