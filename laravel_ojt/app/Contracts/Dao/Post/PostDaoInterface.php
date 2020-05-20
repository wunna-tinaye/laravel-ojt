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
  public function findPostById(Request $request);
  //save post
  public function saveOrUpdatePost(Request $request, User $user);
  //destory post
  public function destoryPost(Post $post);
}
