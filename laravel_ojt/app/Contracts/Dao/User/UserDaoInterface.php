<?php

namespace App\Contracts\Dao\User;
use Illuminate\Http\Request;
use App\Models\User;

interface UserDaoInterface
{
  //get user list
  public function getUserListBySearch(Request $request);
  //save or update
  public function saveOrUpdateUser(Request $Request, User $user);
  //get find user by id
  public function findUserById(Request $Request);
  //destory user
  public function destoryUser(User $user);
}
