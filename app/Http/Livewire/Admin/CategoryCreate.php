<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryCreate extends Component
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
        'name'=> 'required|unique:categories',
        'image'=>'',
        'state'=>''
    ];


    public function save(){

        if($this->image){
            $rules = $this->rules;
            $rules['image'] = 'required|image|max:2048';
            $this->validate();
            $image = $this->image->store('categories', 'public');
            $urlimage = Storage::url($image);
        }
        else {
            $this->validate();
            $urlimage = '/storage/categories/default.jpg';
        }



        //dd($this->state);

        $statee = ($this->state) ? 1 : 0 ;


        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'state' => $statee,
            //'image' => $image,
            'image' => $urlimage,
        ]);

        $this->reset(['open','name','image']);

        $this->emitTo('admin.brand-list','render');

        $this->emit('alert','La Categoria se creo correctamente');
    }




    public function render()
    {
        return view('livewire.admin.category-create');
    }
}
