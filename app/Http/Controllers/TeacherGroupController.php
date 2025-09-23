<?php

namespace App\Http\Controllers;

use App\Services\TeacherGroupService;
use Illuminate\Http\Request;

class TeacherGroupController extends Controller
{
    protected $teacherGroupService;

    public function __construct(TeacherGroupService $teacherGroupService)
    {
        $this->teacherGroupService = $teacherGroupService;
    }

    public function index()
    {
        $groups = $this->teacherGroupService->getAllGroups();

        return response()->json($groups);
    }

    public function show(Request $request)
    {
        $id = $request->user_id;
        $groups = $this->teacherGroupService->getOneTeacherGroups($id);

        return response()->json($groups);
    }

    public function lessons($id)
    {
        $lessons = $this->teacherGroupService->getTeacherLessons($id);

        return response()->json($lessons);
    }

    public function addTeacher(Request $request, $id)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|string',
        ]);
        $teacher_id = $validated['teacher_id'];
        $res = $this->teacherGroupService->addTeacherToGroup($teacher_id, $id);

        return response()->json($res);
    }

    public function deleteTeacher(Request $request, $id)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|uuid',
        ]);
        $teacher_id = $validated['teacher_id'];
        $res = $this->teacherGroupService->deleteTeacherGroup($teacher_id, $id);

        return response()->json($res);
    }
}
