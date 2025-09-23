<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\SubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;

class SubjectController extends Controller
{
    protected $subjectService;
    public function __construct(SubjectService $subjectService)
    {
      $this->subjectService = $subjectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $subjects = $this->subjectService->getAllSubjects();
      return response()->json($subjects, 200);
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
    public function store(SubjectRequest $request)
    {
        $subject = $this->subjectService->createSubject($request->validated());
        return response()->json($subject, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subject = $this->subjectService->getSubjectById(($id));
        return response()->json($subject, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, $id)
    {
        $subject = $this->subjectService->updateSubject($id, $request->validated());
        return response()->json($subject, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->subjectService->deleteSubject($id), 200);
    }
}
