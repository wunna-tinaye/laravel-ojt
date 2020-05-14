<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\User\UserServiceInterface;
use Log;


class UserController extends Controller
{
    private $userInterface;

    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userInterface
     * 
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $request->session()->forget(['name', 'email', 'password', 'password_confirmation', 'type', 'ph', 'dob', 'address', 'image', 'shouldShow']);
        $userList = $this->userInterface->getUserListBySearch($request);
        return view('users.index', compact('userList'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Show the form for confirming of created resource
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
     public function confirm(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required',
        ]);

        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'type' => $request->type,
            'ph' => $request->ph,
            'dob' => $request->dob,
            'address' => $request->address,
        ]);
        return view('users.confirm', compact('request'));
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
        $this->userInterface->saveOrUpdateUser($request, Auth::user());
        $request->session()->forget(['name', 'email', 'password', 'password_confirmation', 'type', 'ph', 'dob', 'address', 'image', 'shouldShow']);
        return redirect()->route('users.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        Log::info("edit");
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, User $user)
    {
        Log::info("update");
        $this->userInterface->saveOrUpdateUser($request, Auth::user());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        Log::info("Delete");
        $this->userInterface->destoryUser($user);
        return redirect()->route('users.index');
    }

    /**
     * Show the form for user's profile
     * @param \App\Models\User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        Log::info("profile");
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for confirming of editing resource
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(Request $request)
    {
        $id = $request->id ? ',' . $request->id : '';
        $request->validate([
            'name' => 'required|max:255|unique:users,name'.$id,
            'email' => 'required|max:255|unique:users,email'.$id,
            'type' => 'required',
        ]);  
        $user = $this->userInterface->findUserById($request);

        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'type' => $request->type,
            'ph' => $request->ph,
            'dob' => $request->dob,
            'address' => $request->address        
        ]);
        return view('users.confirm', compact('request', 'user'));
    }
}
