<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Modelo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\Um;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
//use Rules

class ProductCreate extends Component
{
    use WithFileUploads;
    //public $categories=[], $modelos = [], $brands = [], $ums = [];
    public $categoryy="";
    public $category_id="",  $brand_id="", $modelo_id="", $um_id="", $haveserialnumber=0, $currency_id="", $typeproduct="";
    public $purchaseprice, $saleprice, $salepricemin, $stock, $stockmin, $state;
    public $name, $slug, $description, $image, $codigo, $nameincod;


    protected $rules = [
        'category_id' => 'required',
        'brand_id' => 'required',
        'modelo_id' => 'required',
        'um_id'=>'required',
        'currency_id' => 'required',
        'typeproduct'=> 'required',
        'purchaseprice'=> 'required',
        'saleprice'=> 'required',
        'salepricemin'=> 'required',
        'stock'=> 'required',
        'stockmin'=> 'required',
        'state'=> 'required',
       // 'name'=> 'required|unique',
        'description'=> 'required',
        'image'=> '',
       // 'prodservicio'=>'required',
        'codigo'=>'required',

    ];


    public function updatedCategoryId(){
        $this->nameincod = $this->category_id.$this->brand_id.$this->modelo_id;
        $existnameincod = Product::where('nameincod', $this->nameincod)->get();
       if($existnameincod->count()>0){
        $this->category_id="";
        $this->emit('alert','El Producto ya existe');
    }
    }

    public function updatedBrandId(){
        $this->nameincod = $this->category_id.$this->brand_id.$this->modelo_id;
        $existnameincod = Product::where('nameincod', $this->nameincod)->get();

       if($existnameincod->count()>0){
            $this->brand_id="";
            $this->emit('alert','El Producto ya existe');
        }
    }

    public function updatedCodigo(){

        $existcod = Product::where('codigobarrasi', $this->codigo)->get();

        if($existcod->count()>0){
            $this->codigo="";
            $this->emit('alert','El Código del Producto ya existe, ingrese otro código');
        }
    }

    public function updatedModeloId(){
        $this->nameincod = $this->category_id.$this->brand_id.$this->modelo_id;

        $existnameincod = Product::where('nameincod', $this->nameincod)->get();

        if($existnameincod->count()>0){
            $this->modelo_id="";
            $this->emit('alert','El Producto ya existe');
        }
    }





    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $modelos = Modelo::all();
        $ums = Um::all();
       // $this->nameincod = $this->category_id.$this->brand_id.$this->modelo_id;
        //dd($this->nameincod);

        return view('livewire.admin.product-create', compact('categories', 'brands', 'modelos', 'ums'));

    }

    public function save(){

        $this->validate();

        if($this->image){
            $rules = $this->rules;
            $rules['image'] = 'require|image|max:2048';
            $this->validate();
            $image = $this->image->store('products', 'public');
            $urlimage = Storage::url($image);
        }
        else {
            $this->validate();
            $urlimage = '/storage/products/default.jpg';
        }

        $product = new Product();

        $product->codigo = $this->codigo;
        $product->codigobarrasi = $this->codigo;
        $product->codigobarrase = $this->codigo;

        $product->description = $this->description;
        $product->purchaseprice = $this->purchaseprice;
        $product->saleprice = $this->saleprice;
        $product->salepricemin = $this->salepricemin;
        $product->stock = $this->stock;
        $product->stockmin = $this->stockmin;


        //$categoriasel = Category::where('name', $this->category_id)->get();
        $categoriasel = Category::find($this->category_id);
        //dd($categoriasel);
        //dd($this->category_id);



        //$modelosel = Modelo::where('name', $this->modelo_id)->get();
        $modelosel = Modelo::find($this->modelo_id);


        //$brandsel = Brand::where('name', $this->brand_id)->get();
        $brandsel = Brand::find($this->brand_id);


        if($brandsel and $categoriasel and $brandsel){
            $product->name = $categoriasel->name." ".$modelosel->name." ".$brandsel->name;
        }

        $currencysel = Currency::find($this->currency_id);
        if($currencysel){
            $product->currency_id = $currencysel->id;
        }


        $umsel = Um::find($this->currency_id);
        if($umsel){
            $product->um_id = $umsel->id;
        }


        $product->nameincod = $this->nameincod;
        $product->state = $this->state;
        $product->image = $urlimage;
        $product->typeproduct = $this->typeproduct;
        $product->prodservicio = 1;


        $prodcreado = $product->save();

        return redirect()->route('product.list', $product);


     }


}
