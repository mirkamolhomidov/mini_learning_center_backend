<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Exceptions\HttpResponseException;

class StudentGroupService
{
    public function getAllGroups()
    {
        return StudentGroup::with('student')->with('group')->get();
    }

    public function getOneStudentGroups($student_id)
    {
        return StudentGroup::with('group')->where('student_id', $student_id)->get();
    }

    public function getStudentLessons($student_id)
    {
        $groups = StudentGroup::with('group.lesson')->where('student_id', $student_id)->get();

        return $groups->pluck('group.lesson')->flatten();
    }

    public function getGroupLessons($group_id)
    {
        return Group::with('lesson')->findOrFail($group_id)->lesson;
    }

    public function checkScheduleConflicts($student_id, $group_id)
    {
        $student_lessons = $this->getStudentLessons($student_id);
        $group_lessons = $this->getGroupLessons($group_id);

        foreach ($student_lessons as $slession) {
            foreach ($group_lessons as $glession) {
                if ($slession->weekday == $glession->weekday && $slession->start_time < $glession->end_time && $glession->start_time < $slession->end_time) {
                    return true;
                }
            }
        }

        return false;
    }

    public function addStudentToGroup($student_id, $group_id)
    {
        $group = Group::find($group_id);
        $student = Student::find($student_id);
        if (!$group) throw new HttpResponseException(response()->json(['error' => 'Guruh mavjud emas'], 400));
        if (!$student) throw new HttpResponseException(response()->json(['error' => 'Student mavjud emas'], 400));
        $exists = StudentGroup::where('student_id', $student_id)
            ->where('group_id', $group_id)
            ->exists();

        if ($exists) {
            throw new HttpResponseException(
                response()->json(['error' => 'Student allaqachon guruhda mavjud'], 400));
        }
        if ($this->checkScheduleConflicts($student_id, $group_id)) {
            throw new HttpResponseException(
                response()->json(['error' => 'Student dars jadvali mos kelmaydi'], 400)
            );
        }

        StudentGroup::create([
            'student_id' => $student_id,
            'group_id' => $group_id,
            'status' => 'active',
        ]);

        return ['message' => 'Student guruhga qo\'shildi'];
    }

    public function deleteStudentGroup($student_id, $group_id)
    {
        $row = StudentGroup::where('student_id', $student_id)
            ->where('group_id', $group_id)->first();
        if (! $row) {
            throw new \Exception('Student guruh topilmadi', 404);
        } else {
            $row->delete();
        }

        return ['message' => 'Student guruhdan chiqarildi'];
    }
}
