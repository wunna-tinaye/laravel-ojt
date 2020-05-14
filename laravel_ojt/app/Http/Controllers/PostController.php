<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\Post\PostServiceInterface;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $postInterface;

    /**
     * Create a new controller instance.
     * @param PostServiceInterface $postInterface
     * 
     * @return void
     */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $request->session()->forget(['title', 'description']);
        $postList = $this->postInterface->getPostListBySearch($request);
        return view('posts.index', compact('postList'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Show the form for post confimation
     * @param App\Http\Requests\PostRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function confirm(PostRequest $request)
    {
        $validated = $request->validated();
        session([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return view('posts.confirm', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->postInterface->saveOrUpdatePost($request, Auth::user());
        $request->session()->forget(['title', 'description']);
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Log::info("Edit");
        return view('posts.edit', compact('post'));
    }

    /**
     * Show the form for confirming the specifed resource.
     * 
     * @param App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(PostRequest $request)
    {
        Log::info("UpConfirm");
        $validated = $request->validated();
        session([
            'title' => $request->title,
            'description' => $request->description
        ]);
        $post = $this->postInterface->findPostById($request);
        return view('posts.confirm', compact('request', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Post $post)
    {
        Log::info("Update");
        $this->postInterface->saveOrUpdatePost($request, Auth::user());
        $request->session()->forget(['title','description']);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $this->postInterface->destoryPost($post);
        return redirect()->route('posts.index');

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    /**
     * Show the upload form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('posts.upload');
    }

    /**
     * Import excel save into storage and db
     * @param \Illuminate\Http\Request  $request
     * 
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $request->validate([
    'file' => 'required|max:2048',
]);
$save = $request->file->store('uploads_file', 'public');
try {
    Excel::import(new PostsImport(), $request->file('file'));
} catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
    Storage::delete($save);
    $failures = $e->failures();
    return back()->with('error', $failures);
}
return back();

    }
}
