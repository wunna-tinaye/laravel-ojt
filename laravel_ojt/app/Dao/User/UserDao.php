<?php

namespace App\Dao\User;

use DB;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserListBySearch(Request $request)
  {
    $user = User::leftJoin('users as u', 'u.id', '=', 'users.create_user_id');
    if(isset($request->nameSearch) && !empty($request->nameSearch)) {
      $user = $user->where('users.name', 'like', '%' . $request->nameSearch . '%');
     }
     if(isset($request->emailSearch) && !empty($request->emailSearch)) {
      $user = $user->where('users.email', 'like', '%' . $request->emailSearch . '%');
     }
     if(isset($request->createdFromsearch) && !empty($request->createdFromsearch)) {
      $user = $user->where('users.created_at', '>', $request->createdFromsearch);
     }
     if(isset($request->createdTosearch) && !empty($request->createdTosearch)) {
      $user = $user->where('users.created_at', '<', $request->createdTosearch);
     }
     return $user->paginate(config('constants.admin_pagination_records'), array('users.*', 'u.name as c_name'));
  }

  /**
   * Save Post
   * @param Object
   */
   public function saveOrUpdateUser(Request $request, User $user)
   {
    $userE = $this->findUserById($request);
    if($userE) {
      $userE->name = $request->name;
      $userE->email = $request->email;
      $userE->type = $request->type;
      $userE->profile = $request->image;
      $userE->phone = $request->ph;
      $userE->address = $request->address;
      $userE->dob = $request->dob;
      $userE->updated_user_id = $user->id;
      $userE->save();
    } else {

        User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'type' => $request->type,
          'profile' => $request->image,
          'phone' => $request->ph,
          'address' => $request->address,
          'dob' => $request->dob,
          'create_user_id' => $user->id,
          'updated_user_id' => $user->id
        ]);
      }
   }

    /**
     * Get User
     * @return $user
     */
    public function findUserById(Request $request)
    {
      return User::find($request->id);
    }

    /**
     * Delete user
     * @param User $user
     */
    public function destoryUser(User $user) 
    {
      $user = User::withTrashed()->where('id', $user->id)->first();
      $user->delete();
    }

    /**
     * Change Password
     * @param User $user
     * @param Request $request
     */
    public function updatePassword(Request $request, User $user)
    {
      $user->password = bcrypt($request->password);
      $user->save();
    }
}
