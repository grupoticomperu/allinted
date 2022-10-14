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
       // 'name'=> 'required|unique',
        'description'=> 'required',
        'image'=> '',
        'prodservicio'=>'required',
        'codigo'=>'required',

    ];


    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $modelos = Modelo::all();
        $ums = Um::all();
        $this->name = $this->category_id." ".$this->brand_id." ".$this->modelo_id;

        return view('livewire.admin.product-create', compact('categories', 'brands', 'modelos', 'ums'));

    }

    public function save(){

        //$this->validate();

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


        $categoriasel = Category::where('name', $this->category_id)->get();
        //dd($categoriasel[0]->id);
        if($categoriasel){
            $product->category_id = $categoriasel[0]->id;
        }

        $modelosel = Modelo::where('name', $this->modelo_id)->get();
        if($modelosel){
            $product->modelo_id = $modelosel[0]->id;
        }

        $brandsel = Brand::where('name', $this->brand_id)->get();
        if($brandsel){
            $product->brand_id = $brandsel[0]->id;
        }

        $nameincod = $categoriasel[0]->id.$modelosel[0]->id.$brandsel[0]->id;


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

        $product->name = $this->name;
        $product->nameincod = $nameincod;
        $product->state = $this->state;
        $product->image = $urlimage;
        $product->typeproduct = $this->typeproduct;
        $product->prodservicio = $this->prodservicio;


        $prodcreado = $product->save();

        return redirect()->route('product.list', $product);


     }


}
