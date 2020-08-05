<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::get(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return Student::create($request->all());
        } catch(\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);

        if($student) {
            return response()->json($student, 302);
        }
        
        return response()->json(['message' => 'Não encontrado!'],404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Não encontrado!'],404);
        }

        try {
            $student->update($request->all());

            return [];
        } catch(\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Não encontrado!'],404);
        }

        try {
            $student->delete();

            return [];
        } catch(\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
