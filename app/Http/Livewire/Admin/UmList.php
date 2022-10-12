<?php

namespace App\Http\Livewire\Admin;

use App\Models\Um;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;


class UmList extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $um, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;

    protected $listeners = ['render', 'delete'];

    //queryString permite que viaje parametros en la url y se pueda compartir el url
    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function mount(){

        $this->um = new Um();

    }

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $rules = [
        'um.name'=>'required',
        'um.abbreviation'=>'required',
        'um.state'=>'',

    ];

    public function loadUms(){
        $this->readyToLoad = true;
    }

    public function render()
    {

        if ($this->readyToLoad) {
            $ums = Um::where('name', 'like', '%' .$this->search. '%')
                ->when($this->state, function($query){
                    return $query->where('state',1);
                })
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);

        }else{
            $ums =[];

        }
        return view('livewire.admin.um-list', compact('ums'));

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

    public function activar(Um $um){
        $this->um = $um;

        $this->um->update([
            'state' => 1
        ]);
    }

    public function desactivar(Um $um){
        $this->um = $um;

        $this->um->update([
            'state' => 0
        ]);
    }


    public function delete(Um $um){
        $um->delete();
    }

    public function edit(Um $um){
        $this->um = $um;
        $this->open_edit = true;

    }

    public function cancelar(){

        $this->reset('open_edit','rules');
       // $this->identificador = rand();
       // dd($this->rules);
        //$this->open_edit = false;
    }

    public function update(){
        $rules = $this->rules;
        $rules['um.name'] = 'required|unique:ums,name,'.$this->um->id;

        $this->validate($rules);


        $this->um->save();
        $this->reset('open_edit');
        $this->identificador = rand();
        //$this->emitTo('show-brands', 'render');
        $this->emit('alert','La Unidad de Medida se modificó correctamente');

    }











}
