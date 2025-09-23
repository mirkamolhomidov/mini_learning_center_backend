<?php
namespace App\Services;

use App\Models\Student;
use App\Models\Student_group;

class StudentService
{
  public function getAllStudents()
  {
    return Student::all();
  }
  public function getStudentById($id)
  {
    $student = Student::find($id);

    if ($student) {
      return $student;
    }else {
      throw new \App\Exceptions\StudentNotFoundException("Student not found");
    }
  }
  public function createStudent($data)
  {
    return Student::create($data);
  }
  public function updateStudent($id, $data)
  {
    $student = Student::find($id);

    if ($student) {
      $student->update($data);
      return $student;
    }else {
      throw new \App\Exceptions\StudentNotFoundException("Student not found");
    }
  }
  public function deleteStudent($id)
  {
    $student = Student::find($id);

    if ($student) {
      $student->delete();
      return ['message' => 'Student deleted successfully'];
    }else {
      throw new \App\Exceptions\StudentNotFoundException("Student not found");
    }
  }
}