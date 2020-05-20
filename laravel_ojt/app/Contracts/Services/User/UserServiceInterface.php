<?php

namespace App\Contracts\Services\User;
use Illuminate\Http\Request;
use App\Models\User;

interface UserServiceInterface
{
  //get user list
  public function getUserListBySearch(Request $request);
  //save or update user
  public function saveOrUpdateUser(Request $request, User $user);
  //get find user by id
  public function findUserById(Request $request);
  //destory user
  public function destoryUser(User $user);
  //change password
  public function updatePassword(Request $request, User $user);
  //confirm
  public function confirm(Request $request);
  //updateConfirm
  public function updateConfirm(Request $request, User $user);
}
