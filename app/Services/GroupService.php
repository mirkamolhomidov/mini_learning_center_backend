<?php
namespace App\Services;

use App\Models\Group;

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
      throw new \App\Exceptions\GroupNotFoundException("Group not found");
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
      throw new \App\Exceptions\GroupNotFoundException("Group not found");
    }
  }
  public function deleteGroup($id)
  {
    $group = Group::find($id);

    if ($group) {
      $group->delete();
      return ['message' => 'Group deleted successfully'];
    }else {
      throw new \App\Exceptions\GroupNotFoundException("Group not found");
    }
  }
}