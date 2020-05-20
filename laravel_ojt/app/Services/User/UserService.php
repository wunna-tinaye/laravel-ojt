<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Request $request
   * @return $userList
   */
  public function getUserListBySearch(Request $request)
  {
    return $this->userDao->getUserListBySearch($request);
  }
    /**
     * save post
     * @param Request $request
     * @param User $user
     */
    public function saveOrUpdateUser(Request $request, User $user)
    {
      return $this->userDao->saveOrUpdateUser($request, $user);
    }

    /**
      * Find User By Id
      * @param Request $request
      * @return user
      */
    public function findUserById(Request $request)
    {
      return $this->userDao->findUserById($request);
    }

    /**
     * Delete User
     * @param User $user
     */
    public function destoryUser(User $user) {
      return $this->userDao->destoryUser($user);
    }

    /**
     * update password
     * @param Request $request
     * @param User $user
     */
    public function updatePassword(Request $request, User $user)
    {
      return $this->userDao->updatePassword($request, $user);
    }

    /**
     * create confirm
     * 
     * @param Request $request
     * 
    */
    public function confirm(Request $request)
    {
      if (!empty($request->image)) {
          $request->image = $request->image->store('uploads', 'public');
      } else if (empty($request->image) && !empty($request->back_image)) {
          $request->image = $request->back_image;
      } else if (!empty($request->image) && !empty($request->back_image)) {
          Storage::delete($request->back_image);
          $request->image = $request->image->store('uploads', 'public');
      }

      session([
          'name' => $request->name,
          'email' => $request->email,
          'password' => $request->password,
          'password_confirmation' => $request->password_confirmation,
          'type' => $request->type,
          'ph' => $request->ph,
          'dob' => $request->dob,
          'address' => $request->address,
          'image' => $request->image,
          'shouldShow' => false,
      ]);
    }

      /**
       * update confirm
       * 
       * 
       * @param Request $request
       * @param User $user
      */
    public function updateConfirm(Request $request, User $user) {
        
      if (empty($request->image)) {
          $request->image = $user->profile;
      } else {
          $request->image = $request->image->store('uploads', 'public');
      }

      session([
          'name' => $request->name,
          'email' => $request->email,
          'password' => $request->password,
          'password_confirmation' => $request->password_confirmation,
          'type' => $request->type,
          'ph' => $request->ph,
          'dob' => $request->dob,
          'address' => $request->address,
          'image' => $request->image,
      ]);
    }
}
