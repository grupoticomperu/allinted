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

class ProductCreate extends Component
{

    //public $categories=[], $modelos = [], $brands = [], $ums = [];
    public $categoryy="";
    public $prodservicio="", $category_id="",  $brand_id="", $modelo_id="", $um_id="", $haveserialnumber=0, $currency_id="", $typeproduct="";
    public $purchaseprice, $saleprice, $salepricemin, $stock, $stockmin, $state;
    public $name, $slug, $description, $image, $codigo, $categoryname;


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
        'name'=> 'required',
        'description'=> 'required',
        'image'=> '',
        'prodservicio'=>'required',
        'codigo'=>'required',

    ];



    public function mount(){

/*         $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->modelos = Modelo::all(); */

    }

    public function concatenar($name){
        $this->name = $name;
    }



    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $modelos = Modelo::all();
        $ums = Um::all();

        return view('livewire.admin.product-create', compact('categories', 'brands', 'modelos', 'ums'));

    }

    public function save(){
        //$this->validate();
        $categoriasel = Category::find($this->category_id);
        if($categoriasel){
           // $product->category_id = $categoriasel->id;
            $categorianame = $categoriasel->name;
        }
        else {
            $newcategory = Category::create(['name'=>$this->category_id]);
           // $product->category_id = $newcategory->id;
            $categorianame = $newcategory->name;
        }

        $modelosel = Modelo::find($this->modelo_id);
        if($modelosel){
          //  $product->modelo_id = $modelosel->id;
            $modeloname = $modelosel->name;
        }
        else {
            $newmodelo = Modelo::create(['name'=>$this->modelo_id]);
          //  $product->modelo_id = $newmodelo->id;
            $modeloname = $newmodelo->name;
        }


        $brandsel = Brand::find($this->brand_id);
        if($brandsel){
           // $product->brand_id = $brandsel->id;
            $brandname = $brandsel->name;
        }
        else {
            $newbrand = Brand::create(['name'=>$this->brand_id]);
          //  $product->brand_id = $newbrand->id;
            $brandname = $newbrand->name;
        }

        $this->name = $categorianame." ".$modeloname." ".$brandname;
        $rules = $this->rules;
        $rules['name'] = 'unique';
        $this->validate();


        if($this->image){
           // $rules = $this->rules;
            $rules['image'] = 'image|max:2048';
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
        //$product->name = $this->name;
        $product->description = $this->description;
        $product->purchaseprice = $this->purchaseprice;
        $product->saleprice = $this->saleprice;
        $product->salepricemin = $this->salepricemin;
        $product->stock = $this->stock;
        $product->stockmin = $this->stockmin;

 /*        $product->tipo = $this->prod_servicio;
        $product->haveserialnumber = $this->haveserialnumber;
        $product->gender = $this->gender; */

        //$categoriasel = Category::find($this->category_id);
        if($categoriasel){
            $product->category_id = $categoriasel->id;
           // $categorianame = $categoriasel->name;
        }
        else {
           // $newcategory = Category::create(['name'=>$this->category_id]);
            $product->category_id = $newcategory->id;
           // $categorianame = $newcategory->name;
        }


       // $modelosel = Modelo::find($this->modelo_id);
        if($modelosel){
            $product->modelo_id = $modelosel->id;
           // $modeloname = $modelosel->name;
        }
        else {
           // $newmodelo = Modelo::create(['name'=>$this->modelo_id]);
            $product->modelo_id = $newmodelo->id;
           // $modeloname = $newmodelo->name;
        }



      //  $brandsel = Brand::find($this->brand_id);
        if($brandsel){
            $product->brand_id = $brandsel->id;
          //  $brandname = $brandsel->name;
        }
        else {
          //  $newbrand = Brand::create(['name'=>$this->brand_id]);
            $product->brand_id = $newbrand->id;
           // $brandname = $newbrand->name;
        }


        $currencysel = Currency::find($this->currency_id);
        if($currencysel){
            $product->currency_id = $currencysel->id;
            $currencyname = $currencysel->name;
        }
        else {
            $newcurrency = Currency::create(['name'=>$this->currency_id]);
            $product->currency_id = $newcurrency->id;
            $currencyname = $newcurrency->name;
        }

        $umsel = Um::find($this->currency_id);
        if($umsel){
            $product->um_id = $umsel->id;
        }
        else {
            $newcurrency = Um::create(['name'=>$this->um_id, 'abbreviation'=>$this->um_id]);
            $product->um_id = $newcurrency->id;
        }

        $product->name = $categorianame." ".$modeloname." ".$brandname;
        $product->state = $this->state;
        $product->image = $urlimage;
        $product->typeproduct = $this->typeproduct;
        $product->prodservicio = $this->prodservicio;


        $prodcreado = $product->save();

        return redirect()->route('product.list', $product);


     }


}
