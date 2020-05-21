<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(auth()->user()){
            if(auth()->user()->type == config('constants.admin')) {
                return Post::all();
            } else {
                return Post::where('create_user_id' , '=' , auth()->user()->id)->get();
            }
        } else {
            return Post::all();
        }
    }
}
