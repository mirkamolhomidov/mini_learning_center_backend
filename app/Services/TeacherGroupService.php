<?php

namespace App\Services;

use App\Models\Group;
use App\Models\TeacherGroup;
use Illuminate\Http\Exceptions\HttpResponseException;

class TeacherGroupService
{
    public function getAllGroups()
    {
        return TeacherGroup::with('teacher')->with('group')->get();
    }

    public function getOneTeacherGroups($teacher_id)
    {
        $groups = TeacherGroup::with('group')->where('teacher_id', $teacher_id)->get();
        if($groups){
            return $groups;
        }else{
          throw new HttpResponseException(
            response()->json(['error' => 'Teacher allaqachon guruhda mavjud'], 400));
        }
    }

    public function getTeacherLessons($teacher_id)
    {
        $groups = TeacherGroup::with('group.lesson')->where('teacher_id', $teacher_id)->get();

        return $groups->pluck('group.lesson')->flatten();
    }

    public function getGroupLessons($group_id)
    {
        return Group::with('lesson')->findOrFail($group_id)->lesson;
    }

    public function checkScheduleConflicts($teacher_id, $group_id)
    {
        $teacher_lessons = $this->getTeacherLessons($teacher_id);
        $group_lessons = $this->getGroupLessons($group_id);

        foreach ($teacher_lessons as $tlesson) {
            foreach ($group_lessons as $glession) {
                if ($tlesson->weekday == $glession->weekday && $tlesson->start_time < $glession->end_time && $glession->start_time < $tlesson->end_time) {
                    return true;
                }
            }
        }

        return false;
    }

    public function addTeacherToGroup($teacher_id, $group_id)
    {
        $group = Group::findOrFail($group_id);

        $exists = TeacherGroup::where('teacher_id', $teacher_id)
            ->where('group_id', $group_id)
            ->exists();

        if ($exists) {
            throw new HttpResponseException(
              response()->json(['error' => 'Teacher allaqachon guruhda mavjud'], 400));
        }
        if ($this->checkScheduleConflicts($teacher_id, $group_id)) {
            throw new HttpResponseException(
              response()->json(['error' => 'Teacher dars jadvali mos kelmaydi'], 400)
            );
        }

        TeacherGroup::create([
            'teacher_id' => $teacher_id,
            'group_id' => $group_id,
            'status' => 'active',
        ]);

        return ['message' => 'Teacher guruhga qo\'shildi'];
    }

    public function deleteTeacherGroup($teacher_id, $group_id)
    {
        $row = TeacherGroup::where('teacher_id', $teacher_id)
            ->where('group_id', $group_id)->first();
        if (! $row) {
            throw new \Exception('Teacher guruh topilmadi', 404);
        } else {
            $row->delete();
        }

        return ['message' => 'Teacher guruhdan chiqarildi'];
    }
}
