<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Budget;

class BudgetList extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $search, $image, $budget, $state;
    public $sort='id';
    public $direction='desc';
    public $cant='10';
    public $open_edit = false;
    public $readyToLoad = false;//para controlar el preloader
    //public $category;

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],
    ];

    public function updatingSearch(){
        $this->resetPage();

    }

    protected $rules = [
        'budget.name' => 'required',
        'budget.image'=>'image',
        'budget.state'=>'required',
    ];

    public function loadBudgets(){
        $this->readyToLoad = true;
    }


    public function render()
    {
        $budgets = Budget::all();
        return view('livewire.admin.budget-list',compact('budgets'));
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


    public function activar(Budget $budget){
        $this->budget = $budget;

        $this->budget->update([
            'state' => 1
        ]);
    }

    public function desactivar(Budget $budget){
        $this->budget = $budget;

        $this->budget->update([
            'state' => 0
        ]);
    }

    public function delete(Budget $budget){
        $budget->delete();
    }



}
