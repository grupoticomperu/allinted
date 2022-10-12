<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;

class BrandList extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $image, $brand, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader inicia en false

    protected $listeners = ['render', 'delete'];

    //queryString permite que viaje parametros en la url y se pueda compartir el url
    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    public function mount(){
        $this->identificador = rand();
        $this->brand = new Brand();//se hace para inicializar el objeto e indicar que image es
        $this->image ="";
    }

    //updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación,
    }

    /* 'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */
    protected $rules = [
        //'brand.name'=>'required|unique:brands,name,'.$this->brand->id,
        'brand.name'=>'required',
        'brand.state'=>'',
        'image'=>'',
    ];


    //para controlar la carga
    public function loadBrands(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $brands = Brand::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $brands =[];

        }
        return view('livewire.admin.brand-list', compact('brands'));

    }


    public function order($sort){
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }

    }

    public function activar(Brand $brand){
        $this->brand = $brand;

        $this->brand->update([
            'state' => 1
        ]);
    }

    public function desactivar(Brand $brand){
        $this->brand = $brand;

        $this->brand->update([
            'state' => 0
        ]);
    }


    public function delete(Brand $brand){
        $brand->delete();
    }

    public function edit(Brand $brand){
        $this->brand = $brand;
        $this->open_edit = true;

    }


    public function cancelar(){

        $this->reset('open_edit','image', 'rules');
        $this->identificador = rand();
       // dd($this->rules);
        //$this->open_edit = false;
    }


    public function update(){
        $rules = $this->rules;
        $rules['brand.name'] = 'required|unique:brands,name,'.$this->brand->id;

        if($this->image){
           // dd($this->image);
            $rules['image'] ='required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $this->validate($rules);
            Storage::delete([$this->brand->image]);
            $this->brand->image = Storage::url($this->image->store('brands', 'public'));
        }else{
           // dd($this->image);
            $this->validate($rules);
        }

        $this->brand->save();
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->emitTo('show-brands', 'render');
        $this->emit('alert','La marca se modificó correctamente');

    }




}
