<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staff\StaffRequest;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staffService;
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = $this->staffService->getAllStaffs();
        return response()->json($staffs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $staff = $this->staffService->getOneStaff($id);
        return response()->json($staff);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTeacher(StaffRequest $request)
    {
        $data = $request->validated();
        $id = $request['user_id'];
        $staff = $this->staffService->updateStaff($data, $id);
        return response()->json($staff);
    }
    public function update(StaffRequest $request, $id)
    {
        $data = $request->validated();
        $staff = $this->staffService->updateStaff($data, $id);
        return response()->json($staff);
    }
    public function updateRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:admin,staff',
        ]);
        $role = $validated['role'];
        $staff = $this->staffService->updateStaffRole($role, $id);
        return response()->json($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->staffService->deleteStaff($id);
        return response()->json($response);
    }
}
