<?php

namespace App\Http\Resources;

use App\Services\LinksGenerator;
use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $links = new LinksGenerator;
        $links->addGet('self', route('students.show', $this->id));
        $links->addPut('update', route('students.update', $this->id));
        $links->addDelete('delete', route('students.destroy', $this->id));

        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'enrollment' => (int) $this->enrollment,
            'graduation_limit' => $this->graduationLimit($this->enrollment),
            'course' => new Course($this->course),
            'links' => $links->toArray()
        ];
    }

    public function graduationLimit($enrollment)
    {
        $verificaAno = date('y');
        $periodoAluno = substr($enrollment,0,2);
        $limiteGraduacao = $verificaAno - $periodoAluno;
        return $limiteGraduacao > 5 ? 'Apto a formar' : 'Provavelmente não formou';
    }
}
