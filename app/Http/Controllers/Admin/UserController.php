<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any' , User::class);
        $users = User::orderBy('id' , 'desc')->paginate(5);
        return view('cms.user.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create' , User::class);
        $users = new User();
        $roles = Role::all();
        return view('cms.user.create' , compact('users' , 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create' , User::class);
        $users = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'admin_data' => auth()->user(),
        ]);
        RoleUser::create([
            'role_id' => $request->get('role'),
            'user_id' => $users->id ,
        ]);
        return redirect(route('users.index'))->with('success' , 'User created is done');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        $this->authorize('update' , $users);
        $roles = Role::all();
        return view('cms.user.edit' , compact('users' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $users = User::findOrFail($id);
        $this->authorize('update' , $users);
        $users->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'admin_data' => auth()->user(),
        ]);
        $roles = RoleUser::where('user_id' , '=' , $id);
        $roles->update([
            'role_id' => $request->get('role'),
            'user_id' => $id ,
        ]);
        return redirect(route('users.index'))->with('success' , 'User Updated is done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users=User::findOrFail($id);
        $this->authorize('delete' , $users);
        $users->delete();
        return redirect(route('users.index'))->with('success' , 'User Deleted is done');

    }
}
