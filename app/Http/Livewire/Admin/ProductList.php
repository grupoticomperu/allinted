<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Brand;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductList extends Component
{


    use WithPagination;
    use WithFileUploads;
    public $search, $image, $product, $state;
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
        $this->identificador = rand();
        //$this->brand = new Brand();
        //$this->image ="";
    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }


/*       'brand.name'=> 'required',Rule::unique('brands')->ignore($this->brand->id) */

      protected $rules = [
        'product.name' => 'required',
        'product.image'=>'image',
        'product.state'=>'required',
    ];


    public function loadProducts(){
        $this->readyToLoad = true;
    }

     public function render()
    {


        if ($this->readyToLoad) {
            $products = Product::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $products =[];

        }

        return view('livewire.admin.product-list', compact('products'));


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


    public function activar(Product $product){
        $this->product = $product;

        $this->product->update([
            'state' => 1
        ]);
    }

    public function desactivar(Product $product){
        $this->product = $product;

        $this->product->update([
            'state' => 0
        ]);
    }

    public function delete(Product $product){
        $product->delete();
    }

    public function edit(Product $product){
        $this->product = $product;
        $this->open_edit = true;

    }

/*     public function cancelar(){
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->open_edit = false;
    } */

/*     public function update(){
        //$this->validate();

        if($this->image){
            Storage::delete([$this->brand->image]);
            $this->brand->image = Storage::url($this->image->store('brands', 'public'));
        }

        $this->product->save();
        $this->reset('open_edit', 'image');
        $this->identificador = rand();
        //$this->emitTo('show-brands', 'render');
        $this->emit('alert','El producto se modificó correctamente');

    } */


}
