<?php

namespace App\Contracts\Dao\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
interface PostDaoInterface
{
  //get post list by search
  public function getPostListBySearch(Request $request);
  //get find post by id
  public function findPostById(Request $Request);
  //save post
  public function saveOrUpdatePost(Request $Request, User $user);
  //destory post
  public function destoryPost(Post $post);
}
