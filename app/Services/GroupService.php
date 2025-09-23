<?php
namespace App\Services;

use App\Models\Group;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupService
{
  public function getAllGroups()
  {
    return Group::with('subject')->get();
  }
  public function getGroupById($id)
  {
    $group = Group::with('subject')->find($id);

    if ($group) {
      return $group;
    }else {
      throw new HttpResponseException(
        response()->json(["Group not found"], 404)
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
    }else {
      throw new HttpResponseException(
        response()->json(["Group not found"], 404)
      );
    }
  }
  public function deleteGroup($id)
  {
    $group = Group::find($id);

    if ($group) {
      $group->delete();
      return ['message' => 'Group deleted successfully'];
    }else {
      throw new HttpResponseException(
        response()->json(["Group not found"], 404)
      );
    }
  }
}