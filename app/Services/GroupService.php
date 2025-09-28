<?php

namespace App\Services;

use App\Models\Group;
use App\Models\StudentGroup;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupService
{
    public function getAllGroups()
    {
        return Group::with('subject')->get();
    }

    public function getGroupStudents($group_id)
    {
        $students = StudentGroup::with('student')->where('group_id', $group_id)->orderByDesc('score')->get();

        if (! $students) {
            throw new HttpResponseException(response()->json(['error' => 'Bu guruhga o\'quvchilar biriktirilmagan']));
        }

        $students = $students->values()->map(function ($student, $index) {
          $student->ranking = $index + 1;
          return $student;
        });

        return $students;
    }

    public function getGroupById($id)
    {
        $group = Group::with('subject')->find($id);

        if ($group) {
            return $group;
        } else {
            throw new HttpResponseException(
                response()->json(['Group not found'], 404)
            );
        }
    }

    public function createGroup($data)
    {
        return Group::create($data);
    }

    public function updateGroup($id, $data)
    {
        $group = Group::find($id);

        if ($group) {
            $group->update($data);

            return $group;
        } else {
            throw new HttpResponseException(
                response()->json(['Group not found'], 404)
            );
        }
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id);

        if ($group) {
            $group->delete();

            return ['message' => 'Group deleted successfully'];
        } else {
            throw new HttpResponseException(
                response()->json(['Group not found'], 404)
            );
        }
    }
}
