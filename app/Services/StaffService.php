<?php

namespace App\Services;

use App\Models\Staff;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class StaffService{
    public function getAllStaffs()
    {
        return Staff::all();
    }
    public function getOneStaff($staff_id)
    {
        $staff = Staff::find($staff_id);
        if(!$staff){
            throw new HttpResponseException(
              response()->json(['messge' => 'Staff not found'], 404)
            );
        }
        return $staff;
    }
    public function createStaff($data)
    {
        $data['password'] = Hash::make($data['password']);
        $staff = Staff::create($data);
        return $staff;
    }
    public function updateStaff($data, $staff_id)
    {
        $staff = Staff::find($staff_id);

        if (!$staff) {
            throw new HttpResponseException(
              response()->json(['message' => 'Staff not found'], 404)
            );
        }
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        $staff = $staff->update($data);
        return $staff;
    }
    public function updateStaffRole($role, $staff_id)
    {
        $staff = Staff::find($staff_id);
        if(!$staff){
            throw new HttpResponseException(
              response()->json(['message' => 'Staff not found'], 404)
            );
        }
        $staff->role = $role;
        $staff->save();
        return $staff;
    }
    public function deleteStaff($staff_id)
    {
        $staff = Staff::find($staff_id);
        if(!$staff){
            throw new HttpResponseException(
              response()->json(['message' => 'Staff not found'], 404)
            );
        }
        $staff->delete();
        return ['message' => 'Staff deleted successfully'];
    }
}