<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
class PostDao implements PostDaoInterface
{
  /**
   * Get Post List
   * @return $postList
   */
   public function getPostListBySearch(Request $request)
   {
     return Post::leftJoin('users as u', 'u.id', '=', 'posts.create_user_id')
                ->when($request->search, function($qr) use ($request) {
                    $qr->where(function($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->search . '%')
                                ->orWhere('description', 'like', '%' . $request->search . '%');
                    });
                })->when(auth()->user()->type == config('constants.user'), function($qw) {
                    $qw->where('posts.create_user_id', '=' , auth()->user()->id);                  
                })->paginate(auth()->user()->type == config('constants.admin') ? config('constants.admin_pagination_records') : config('constants.user_pagination_records'), array('posts.*', 'u.name as c_name'));
    }
  
  /**
   * Get Post
   * @return $post
   */
  public function findPostById(Request $request)
  {
    return Post::find($request->id);
  }

  /**
   * Save Post
   * @param User $user
   * @param Request $request
   */
   public function saveOrUpdatePost(Request $request, User $user)
   {
     $post = $this->findPostById($request);
     if($post) {
        $post->title = $request->title;
        $post->description = $request->description;
        $post->updated_user_id = $user->id;
        if($request->status == "0") {
          $post->status = 1;
        } else {
          $post->status = 0;
        }
        $post->save();
     } else {
        Post::create([
          'title' => $request->title,
          'description' => $request->description,
          'create_user_id' => $user->id,
          'updated_user_id' => $user->id
        ]);
     }
   }

   /**
    * Delete post
    * @param Post $post
    */
  public function destoryPost(Post $post) {
    $post = Post::withTrashed()->where('id', $post->id)->first();
    $post->delete();
  }
}
