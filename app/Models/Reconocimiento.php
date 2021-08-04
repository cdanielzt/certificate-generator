<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconocimiento extends Model
{
    use HasFactory;


    public function cliente(){

        return $this->belongsTo(Cliente::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function design(){
        return $this->belongsTo(Design::class);
    }

}
