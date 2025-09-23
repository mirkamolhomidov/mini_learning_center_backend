<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\GroupRequest;
use App\Models\Group;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $groupService;
    public function __construct(GroupService $groupService)
    {
      $this->groupService = $groupService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $groups = $this->groupService->getAllGroups();
      return response()->json($groups, 200);
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
    public function store(GroupRequest $request)
    {
        $group = $this->groupService->createGroup($request->validated());
        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $group = $this->groupService->getGroupById(($id));
        return response()->json($group, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, $id)
    {
        $group = $this->groupService->updateGroup($id, $request->validated());
        return response()->json($group, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json($this->groupService->deleteGroup($id), 200);
    }
}
