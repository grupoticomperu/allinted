<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Modelo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\Um;

class ProductCreate extends Component
{

    public $categories=[], $modelos = [], $brands = [], $ums = [];
    public $categoryy="";
    public $prod_servicio="", $category_id,  $brand_id, $modelo_id, $um_id, $haveserialnumber=0;
    public $name, $slug, $description, $price, $quantity;


    protected $rules = [
        'prod_servicio' => 'required',
        'category_id' => 'required',
        'brand_id' => 'required',
        'modelo_id' => 'required',

    ];



    public function mount(){

/*         $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->modelos = Modelo::all(); */

    }



    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $modelos = Modelo::all();

        return view('livewire.admin.product-create', compact('categories', 'brands', 'modelos'));

    }

    public function save(){
        $this->validate();

        $product = new Product();

        $product->simplecompound = $this->simplecompound;
        $product->tipo = $this->prod_servicio;
        $product->haveserialnumber = $this->haveserialnumber;
        $product->gender = $this->gender;

        $categoriasel = Category::find($this->category_id);
       // dd($categoriasel);
        if($categoriasel){
            $product->category_id = $categoriasel->id;
            $categorianame = $categoriasel->name;
        }
        else {
            $newcategory = Category::create(['name'=>$this->category_id]);
            $product->category_id = $newcategory->id;
            $categorianame = $newcategory->name;
        }
        //->first()? $cat : Category::create(['name'=>$cat]);
        //dd($categorianame );

        //$categorianame = $categoriasel->name;

        $modelosel = Modelo::find($this->modelo_id);
       // dd($categoriasel);
        if($modelosel){
            $product->modelo_id = $modelosel->id;
            $modeloname = $modelosel->name;
        }
        else {
            $newmodelo = Modelo::create(['name'=>$this->modelo_id]);
            $product->modelo_id = $newmodelo->id;
            $modeloname = $newmodelo->name;
        }



        $brandsel = Brand::find($this->brand_id);

        if($brandsel){
            $product->brand_id = $brandsel->id;
            $brandname = $brandsel->name;
        }
        else {
            $newbrand = Brand::create(['name'=>$this->brand_id]);
            $product->brand_id = $newbrand->id;
            $brandname = $newbrand->name;
        }



        $product->name = $categorianame." ".$modeloname." ".$brandname;

        $prodcreado = $product->save();

       return redirect()->route('product.list', $product);


     }


}
