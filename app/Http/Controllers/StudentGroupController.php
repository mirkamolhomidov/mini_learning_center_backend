<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentGroupRequest;
use App\Services\StudentGroupService;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    protected $studentGroupService;

    public function __construct(StudentGroupService $studentGroupService)
    {
        $this->studentGroupService = $studentGroupService;
    }

    public function index()
    {
        $groups = $this->studentGroupService->getAllGroups();

        return response()->json($groups);
    }

    public function show($id)
    {
        $groups = $this->studentGroupService->getOneStudentGroups($id);

        return response()->json($groups);
    }

    public function lessons($id)
    {
        $lessons = $this->studentGroupService->getStudentLessons($id);

        return response()->json($lessons);
    }

    public function addStudent(StudentGroupRequest $request, $id)
    {
        $validated = $request->validated();
        $student_id = $validated['student_id'];
        $res = $this->studentGroupService->addStudentToGroup($student_id, $id);

        return response()->json($res);
    }

    public function deleteStudent(StudentGroupRequest $request, $id)
    {
        $validated = $request->validated();
        $student_id = $validated['student_id'];
        $res = $this->studentGroupService->deleteStudentGroup($student_id, $id);

        return response()->json($res);
    }
}
