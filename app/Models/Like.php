<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public function livros(){
        return $this->hasMany('App\Models\Livro','id_livro');
    }
    public function users(){
        return $this->hasMany('App\Models\User','id_user');
    }
}
