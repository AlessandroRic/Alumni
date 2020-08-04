<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'birth', 'enrollment', 'course_id'];
    /**
     * Mapeamento do curso com referência aos estudantes
     */

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
