<?php

namespace App\Http\Livewire\Admin;

use App\Models\Modelo;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ModeloCreate extends Component
{

    use WithFileUploads;
    public $open = false;
    public $name, $state, $image, $identificador;


    public function mount(){
        $this->identificador=rand();
    }

    public function nuevo(){
        $this->identificador=rand();
        $this->open = true;
        $this->reset(['image']);

    }


    protected $rules = [
        'name'=> 'required|unique:brands',
        'image'=>'',
        'state'=>''
    ];


    public function save(){

        if($this->image){
            $rules = $this->rules;
            $rules['image'] = 'required|image|max:2048';
            $this->validate();
            $image = $this->image->store('modelos', 'public');
            $urlimage = Storage::url($image);
        }
        else {
            $this->validate();
            $urlimage = '/storage/modelos/default.jpg';
        }



        //dd($this->state);

        $statee = ($this->state) ? 1 : 0 ;


        Modelo::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'state' => $statee,
            //'image' => $image,
            'image' => $urlimage,
        ]);

        $this->reset(['open','name','image']);

        $this->emitTo('admin.modelo-list','render');

        $this->emit('alert','El modelo se creo correctamente');
    }



    public function render()
    {
        return view('livewire.admin.modelo-create');
    }
}
