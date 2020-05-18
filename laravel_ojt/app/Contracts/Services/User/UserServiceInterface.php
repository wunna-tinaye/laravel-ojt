<?php

namespace App\Contracts\Services\User;
use Illuminate\Http\Request;
use App\Models\User;

interface UserServiceInterface
{
  //get user list
  public function getUserListBySearch(Request $request);
  //save or update user
  public function saveOrUpdateUser(Request $Request, User $user);
  //get find user by id
  public function findUserById(Request $Request);
  //destory user
  public function destoryUser(User $user);
  //change password
  public function updatePassword(Request $Request, User $user);
}
