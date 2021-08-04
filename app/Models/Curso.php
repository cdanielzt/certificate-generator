<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;


    public function reconocimientos(){

        return $this->hasMany(Reconocimiento::class);
    }

    public function asistenciasCurso(){

        return $this->hasMany(AsistenciaCurso::class);
    }

}
