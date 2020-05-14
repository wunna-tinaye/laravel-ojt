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
      * @param Request $Request
      * @return user
      */
    public function findUserById(Request $Request)
    {
      return $this->userDao->findUserById($Request);
    }

    /**
     * Delete User
     * @param User $user
     */
    public function destoryUser(User $user) {
      return $this->userDao->destoryUser($user);
    }
}
