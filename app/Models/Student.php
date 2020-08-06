<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Indica Atributos para definição de dados em Massa
     */
    protected $fillable = ['name','birth','enrollment','course_id'];
    
    /**
     * Conversão ao serializar dados referentes a data de nascimento
     */
    protected $casts = [
        'birth' => 'date:d/m/Y'
    ];

    /**
     * Define quais atributos não serão apresentados na serialização
     */
    protected $hidden = ['created_at', 'updated_at'];
   
    /**
     * Define quais atributos podem ser apresentados na serialização
     * 
     * protected $visible = ['name', 'birth', 'enrollment'];
     */

     /**
      * Define atributos dinâmicos anexos a serialização
      */
    protected $appends = ['graduation_limit'];

    /**
     * Mapeamento do curso com referência aos estudantes
     */

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }


    /**
     * Adiciona um atributo dinâmico no model de estudante
     */
    public function getGraduationLimitAttribute()
    {
        $verificaAno = date('y');
        $periodoAluno = substr($this->attributes['enrollment'],0,2);
        $limiteGraduacao = $verificaAno - $periodoAluno;
        return $limiteGraduacao > 5 ? 'Apto a formar' : 'Provavelmente não formou';
    }
}
