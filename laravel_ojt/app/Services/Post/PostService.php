<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PostsImport;
use Illuminate\Support\Facades\Storage;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param PostDaoInterface
   * @return void
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Post List
   * 
   * @return $postList
   */
   public function getPostListBySearch(Request $request)
   {
     return $this->postDao->getPostListBySearch($request);
   }

   /**
    * Find Post By Id

    * @param Request $request
    * @return post
    */
  public function findPostById(Request $request)
  {
    return $this->postDao->findPostById($request);
  }

  /**
   * Save post
   * 
   * @param Request $request
   * @param User $user
   * @return post
   */
   public function saveOrUpdatePost(Request $request, User $user)
   {
     return $this->postDao->saveOrUpdatePost($request, $user);
   }

   /**
    * SoftDelete post
    *
    * @param Post $post
    */
  public function destoryPost(Post $post) {
    return $this->postDao->destoryPost($post);
  }

    /**
     * Import file
     * @param Request $request
     * @return post
    */
  public function import(Request $request){
    $save = $request->file->store('uploads_file', 'public');
    try {
        Excel::import(new PostsImport(), $request->file('file'));
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        Storage::delete($save);
        $failures = $e->failures();
        return back()->with('error', $failures);
    }
    return redirect()->route('posts.index');
  }
}
