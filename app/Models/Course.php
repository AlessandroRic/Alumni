<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name'];
    /**
     * Mapeamento dos estudantes com referência aos cursos
     */

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
