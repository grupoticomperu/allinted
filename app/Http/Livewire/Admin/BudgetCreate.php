<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use Livewire\Component;

class BudgetCreate extends Component
{

    //public $search;
    public $total;
    public $mensaje;
    public $prueba = "10";
    public $codigo;
    public $itemsQuantity;
/*     public $price;
     */
    public $cantt=[];
    public $canttt;
    public $cart;

    //public $tipocomprobante_id;
    //public $serie, $numero;
    //public $customer_id;
    //public $numdoc;



    public function mount()
    {
        $this->cart = Cart::getContent()->sortBy('name');
    }


     // actualizar cantidad item en carrito
     public function updateQty($product, $cant = 1)
     {
              dd($cant);
             if ($cant <= 0)
                     $this->removeItem($product);
             else
                     $this->updateQuantity($product, $cant);
     }


     public function updateQuantity($product, $cant = 1)
     {
             $title = '';

             $product = Product::where('codigo', $product)->first();
             //$product = Product::find($product, ['codigobarras']);
             //dd($product );
             $exist = Cart::get($product->codigo);//busco el producto
             if ($exist) {
                     $this->removeItem($product->codigo);
             }

             if ($cant > 0) {
                     Cart::add($product->codigo, $product->name, 10, $cant, $product->image);
                     //$this->total = Cart::getTotal();
                      $this->itemsQuantity = Cart::getTotalQuantity();

                     // $this->emit('scan-ok', $title);

             }
     }


    // buscar y agregar producto por escaner y/o manual
    public function ScanCode($codigo)
    {
        //$this->prueba = $name;
        // dd("Hola");
        //$this->ScanearCode($barcode, $cant);
        $cant = 1;
        $product = Product::where('codigo', $codigo)->first();
        //dd($product);

        if ($product == null || empty($product)) {
            //$this->emit('alert','El Producto no existe ...');
            $this->mensaje = 'El producto no está registrado';
            //$this->emit('scan-ok', $title);
        } else {

            if ($this->InCart($product->codigo)) {
                $this->IncreaseQuantity($product, $cant = 1);
                return;
            }

            Cart::add($product->codigo, $product->name, $product->saleprice, $cant, $product->image);
            //Cart::add($product->id, $product->name, $product->saleprice, $cant, $product->image);
            //$this->total = Cart::getTotal();
             $this->itemsQuantity = Cart::getTotalQuantity();
        }
    }

    public function InCart($productId)
    {
        $exist = Cart::get($productId); //para ver si existe
        if ($exist)
            return true;
        else
            return false;
    }


    public function IncreaseQuantity($product, $cant = 1)
    {
        $title = '';

        $exist = Cart::get($product->codigo); //para ver si existe
        //dd($exist->price);
        if ($exist)
            // $title = 'Cantidad actualizada*';
            $price = $exist->saleprice;
        else
            // $title = 'Producto agregado*';
            $price = $product->saleprice;

            Cart::add($product->codigo, $product->name, 10, $cant, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        // $this->emit('scan-ok', $title);
    }


    public function removeItem($productId)
    {
            Cart::remove($productId);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', 'Producto eliminado*');
    }

    public function render()
    {

        $this->cart = Cart::getContent()->sortBy('name');
        return view('livewire.admin.budget-create', compact($this->cart));
    }
}
