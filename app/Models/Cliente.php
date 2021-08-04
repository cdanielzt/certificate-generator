<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function reconocimientos(){

        return $this->hasMany(Reconocimiento::class);
    }

    public function asistenciascurso(){

        return $this->hasMany(AsistenciaCurso::class);
    }


}
