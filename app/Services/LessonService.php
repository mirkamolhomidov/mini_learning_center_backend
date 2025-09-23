<?php
namespace App\Services;

use App\Models\Lesson;

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
      throw new \App\Exceptions\LessonNotFoundException("Lesson not found");
    }
  }
  public function createLesson($data)
  {
    return Lesson::create($data);
  }
  public function updateLesson($id, $data)
  {
    $lesson = Lesson::find($id);

    if ($lesson) {
      $lesson->update($data);
      return $lesson;
    }else {
      throw new \App\Exceptions\LessonNotFoundException("Lesson not found");
    }
  }
  public function deleteLesson($id)
  {
    $lesson = Lesson::find($id);

    if ($lesson) {
      $lesson->delete();
      return ['message' => 'Lesson deleted successfully'];
    }else {
      throw new \App\Exceptions\LessonNotFoundException("Lesson not found");
    }
  }
}