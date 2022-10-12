<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Comprobantepurchase;

class PurchaseList extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $image, $purchase, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    public $category;

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];


    public function mount(){
        //$this->identificador = rand();
        $this->purchase = new Comprobantepurchase();//se hace para inicializar el objeto e indicar que image es
       // $this->image ="";



    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


/*       'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

     protected $rules = [
        'purchase.name' => 'required',
        'purchase.image'=>'image',
        'purchase.state'=>'required',
    ];


    public function loadPurchase(){
        $this->readyToLoad = true;
    }

    public function render()
    {

/*
        if ($this->readyToLoad) {
            $purchase = Comprobantepurchase::where('name', 'like', '%' .$this->search. '%')
                ->orwhere('numero', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $purchase =[];

        } */

        $purchase = Comprobantepurchase::all();

        return view('livewire.admin.purchase-list', compact('purchase'));


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


    public function activar(Comprobantepurchase $purchase){
        $this->purchase = $purchase;

        $this->purchase->update([
            'state' => 1
        ]);
    }

    public function desactivar(Comprobantepurchase $purchase){
        $this->purchase = $purchase;

        $this->purchase->update([
            'state' => 0
        ]);
    }

    public function delete(Comprobantepurchase $purchase){
        $purchase->delete();
    }

    public function edit(Comprobantepurchase $purchase){
        $this->purchase = $purchase;
        $this->open_edit = true;

    }

/*     public function cancelar(){
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->open_edit = false;
    } */

    public function update(){
        //$this->validate();

/*         if($this->image){
            Storage::delete([$this->brand->image]);
            $this->brand->image = Storage::url($this->image->store('brands', 'public'));
        } */

        $this->purchase->save();
        $this->reset('open_edit', 'image');
       // $this->identificador = rand();
        //$this->emitTo('show-brands', 'render');
        $this->emit('alert','El producto se modificó correctamente');

    }



}
