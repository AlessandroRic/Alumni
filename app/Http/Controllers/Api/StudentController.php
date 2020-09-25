<?php
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Alumni Api",
 *      description="Alumni ApiRest OpenSource",
 *      @OA\Contact(
 *          email="argferreira1@gmail.com"
 *      ),
 * )
 */


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use App\Returns\ReturnXml;

class StudentController extends Controller
{
    use ReturnXml;
    /**
     * @OA\Get(
     *      path="/api/students",
     *      operationId="getstudentsList",
     *      tags={"students"},
     *      summary="Get list of students",
     *      description="Returns list of students",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *     )
     *
     * Returns list of students
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new StudentCollection(Student::paginate(10)))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $request['birth'] = date('Y-m-d', strtotime($request['birth']));

        return Student::create($request->all());
    }

    /**
     * @OA\Get(
     *      path="/api/students/{id}",
     *      operationId="getstudentsById",
     *      tags={"students"},
     *      summary="Get students information",
     *      description="Returns students data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Student id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if (request()->header("Accept") === "application/xml") {
            $student = $student->toArray();
            return $this->modeXml($student);
        }
        // if (request()->wantsJson() || null) {
        //     return new StudentResource($student);
        // }
        return new StudentResource($student);

        // return response(['message' => 'Formato de resposta inválido.']);
    }

    /**
     * @OA\Put(
     *      path="/api/students/{id}",
     *      operationId="putstudentById",
     *      tags={"students"},
     *      summary="Put student information",
     *      description="Returns student data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());
        return [csrf_token()];
    }

    /**
     * @OA\Delete(
     *      path="/api/students/{id}",
     *      operationId="deletestudentById",
     *      tags={"students"},
     *      summary="Delete student information",
     *      description="Returns student data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Student id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return [];
    }
}
