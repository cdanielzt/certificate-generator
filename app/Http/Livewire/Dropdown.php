<?php

namespace App\Http\Livewire;

use App\Models\AsistenciaCurso;
use Livewire\Component;

class Dropdown extends Component
{

    public $asistencias;
    public $cursoId = 0;

    protected $listeners = ['cambioCurso' => 'cambioCurso'];


    public function mount(){
        $this->asistencias = collect(AsistenciaCurso::where('curso_id',$this->cursoId)->get());
    }

    public function cambioCurso($id){
        if($id){
            $this->cursoId = $id;
            $this->asistencias = collect(AsistenciaCurso::where('curso_id',$id)->get());
        }
    }

    public function render()
    {
        return view('livewire.dropdown');
    }
}
