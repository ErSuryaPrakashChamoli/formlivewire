<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;

class MultiStepForm extends Component
{

    use WithFileUploads;
    public $first_name;
    public $last_name;
    public $gender;
    public $age;
    public $description;
    public $email;
    public $phone;
    public $registance;
    public $city;
    public $frameworks = [];
    public $cv;
    public $terms;

    public $totalSteps     = 4;
    public $currentSteps   = 1;

    public function mount(){
        $this->currentSteps = 1;
    }

    public function decreaseStep(){
        $this->resetErrorBag();
        $this->validateData();
        $this->currentSteps--;
        if($this->currentSteps < 1){ 
               $this->currentSteps = $this->totalSteps;
        }

    }

    public function increaseValue(){
        $this->resetErrorBag();
        $this->validateData();
         $this->currentSteps++;
         if($this->currentSteps > $this->totalSteps){
            $this->currentSteps = $this->totalSteps;
            $this->currentSteps = 1;

         }

    }

   public function validateData(){
     if($this->currentSteps == 1){ 

        $this->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'gender'     =>  'required',
            'age'        => 'required|digits:2'
        ]);

     }
     elseif($this->currentSteps == 2){
        $this->validate([
            'email'      => 'required|email|unique:students',
            'phone'      => 'required',
            'registance' => 'required',
            'city'       => 'required'

        ]);

     }
     elseif($this->currentSteps == 3){
        $this->validate([
            // 'frameworks' => 'required|array|min:2|max:4'
            'frameworks' => 'required'
        ]);

     }


   }

    public function register(){
        dd("call");
        // $this->resetErrorBag();
        // if($this->currentSteps == 4){
        //     $this->validate([
        //         $this->validate([
        //             'cv' => 'required|mimes:doc,docx,pdf|max:1024',
        //             'terms' => 'accepted'

        //         ])
        //     ]);
        // }

        // dd("now ,you can submit form");

    }

    public function render()
    {
        return view('livewire.multi-step-form');
    }
}
