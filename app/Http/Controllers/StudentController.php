<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;
    public function __construct(StudentService $studentService)
    {
      $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $students = $this->studentService->getAllStudents();
      return response()->json($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $student = $this->studentService->createStudent($request->validated());
        return response()->json($student, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = $this->studentService->getStudentById(($id));
        return response()->json($student, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $student = $this->studentService->updateStudent($id, $request->validated());
        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->studentService->deleteStudent($id), 200);
    }
}
