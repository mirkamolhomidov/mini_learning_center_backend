<?php
namespace App\Services;

use App\Models\Group;
use App\Models\Lesson;
use Illuminate\Http\Exceptions\HttpResponseException;

class LessonService
{
  public function getAllLessons()
  {
    return Lesson::with('group')->get();
  }
  public function getLessonById($id)
  {
    $lesson = Lesson::with('group')->find($id);

    if ($lesson) {
      return $lesson;
    }else {
      throw new HttpResponseException(
        response()->json(["Lesson not found"], 404)
      );
    }
  }
  public function createLesson($data)
  {
    $group = Group::find($data->group_id);
    if(!$group) throw new HttpResponseException(response()->json(['Group not found'], 400));
    return Lesson::create($data);
  }
  public function updateLesson($id, $data)
  {
    $lesson = Lesson::find($id);

    if ($lesson) {
      $lesson->update($data);
      return $lesson;
    }else {
      throw new HttpResponseException(
        response()->json(["Lesson not found"], 404)
      );
    }
  }
  public function deleteLesson($id)
  {
    $lesson = Lesson::find($id);

    if ($lesson) {
      $lesson->delete();
      return ['message' => 'Lesson deleted successfully'];
    }else {
      throw new HttpResponseException(
        response()->json(["Lesson not found"], 404)
      );
    }
  }
}