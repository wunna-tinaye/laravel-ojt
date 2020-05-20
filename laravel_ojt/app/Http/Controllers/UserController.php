<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\User\UserServiceInterface;


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
        $this->middleware('auth');
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
     public function confirm(UserRequest $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required_if:back_image,',
        ]);
        $this->userInterface->confirm($request);
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
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for confirming of editing resource
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(UserRequest $request)
    {
        $user = $this->userInterface->findUserById($request);
        $this->userInterface->updateConfirm($request, $user);
        return view('users.confirm', compact('request', 'user'));
    }

    /**
     * Show the form for password change
     * @param \App\Models\User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function changePassword(User $user)
    {
        return view('users.change-password', compact('user'));
    }

    /**
     * Store change password into storage
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function changedPassword(Request $request,User $user)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if(!Hash::check($request->old_password, $user->password)){
            return back()->with('error','The specified password does not match the database password');
        }else{
            $this->userInterface->updatePassword($request, $user);
            return redirect()->route('posts.index');
        }
    }
}
