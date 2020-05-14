<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param PostDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Post List
   * @return $postList
   */
   public function getPostListBySearch(Request $request)
   {
     return $this->postDao->getPostListBySearch($request);
   }

   /**
    * Find Post By Id
    * @param Request $Request
    * @return post
    */
  public function findPostById(Request $Request)
  {
    return $this->postDao->findPostById($Request);
  }

  /**
   * save post
   * @param Request $request
   * @param User $user
   * @return post
   */
   public function saveOrUpdatePost(Request $request, User $user)
   {
     return $this->postDao->saveOrUpdatePost($request, $user);
   }

   /**
    * Delete post
    * @param Post $post
    */
  public function destoryPost(Post $post) {
    return $this->postDao->destoryPost($post);
  }
}
