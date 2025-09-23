<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\LessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Services\LessonService;

class LessonController extends Controller
{
    protected $lessonService;
    public function __construct(LessonService $lessonService)
    {
      $this->lessonService = $lessonService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $lessons = $this->lessonService->getAllLessons();
      return response()->json($lessons, 200);
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
    public function store(LessonRequest $request)
    {
        $lesson = $this->lessonService->createLesson($request->validated());
        return response()->json($lesson, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = $this->lessonService->getLessonById(($id));
        return response()->json($lesson, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request, $id)
    {
        $lesson = $this->lessonService->updateLesson($id, $request->validated());
        return response()->json($lesson, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->lessonService->deleteLesson($id), 200);
    }
}
