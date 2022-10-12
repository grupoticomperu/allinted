<?php

namespace App\Http\Livewire\Admin;

use App\Models\Modelo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ModeloList extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $image, $modelo, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader inicia en false

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function mount(){
        $this->identificador = rand();
        $this->modelo = new Modelo();//se hace para inicializar el objeto e indicar que image es
        $this->image ="";
    }

    public function updatingSearch(){
        $this->resetPage();
        //RESETEA la paginación,
    }

    protected $rules = [
        //'brand.name'=>'required|unique:brands,name,'.$this->brand->id,
        'modelo.name'=>'required',
        'modelo.state'=>'',
        'image'=>'',
    ];

    public function loadModelos(){
        $this->readyToLoad = true;
    }



    public function render()
    {

        if ($this->readyToLoad) {
            $modelos = Modelo::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $modelos =[];

        }
        return view('livewire.admin.modelo-list', compact('modelos'));

    }
}
