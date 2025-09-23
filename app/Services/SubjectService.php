<?php
namespace App\Services;

use App\Models\Subject;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubjectService
{
  public function getAllSubjects()
  {
    return Subject::all();
  }
  public function getSubjectById($id)
  {
    $subject = Subject::find($id);

    if ($subject) {
      return $subject;
    }else {
      throw new HttpResponseException(
        response()->json(["Subject not found"], 404)
      );
    }
  }
  public function createSubject($data)
  {
    return Subject::create($data);
  }
  public function updateSubject($id, $data)
  {
    $subject = Subject::find($id);

    if ($subject) {
      $subject->update($data);
      return $subject;
    }else {
      throw new HttpResponseException(
        response()->json(["Subject not found"], 404)
      );
    }
  }
  public function deleteSubject($id)
  {
    $subject = Subject::find($id);

    if ($subject) {
      $subject->delete();
      return ['message' => 'Subject deleted successfully'];
    }else {
      throw new HttpResponseException(
        response()->json(["Subject not found"], 404)
      );
    }
  }
}