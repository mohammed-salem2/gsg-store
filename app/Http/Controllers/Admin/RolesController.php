<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any' , Role::class);
        // Gate::authorize('roles.index');
        $roles = Role::orderBy('id' , 'desc')->paginate();
        return view('cms.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create' , Role::class);
        // Gate::authorize('roles.create');
        $roles = new Role();
        return view('cms.role.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create' , Role::class);
        // Gate::authorize('roles.create');
        // dd($request->all());
        $role = Role::create([
            'name' => $request->get('name') ,
            'abilities' => $request->get('abilities'),
            'admin_data' => auth()->user(),
        ]);
        return redirect(route('roles.index'))->with('success' , 'Role Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roles = Role::findOrFail($id);
        $this->authorize('view' , $roles);
        // Gate::authorize('roles.view');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Gate::authorize('roles.update');
        $roles = Role::findOrFail($id);
        $this->authorize('update' , $roles);
        return view('cms.role.edit' , compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        // Gate::authorize('roles.update');
        $roles = Role::findOrFail($id);
        $this->authorize('update' , $roles);
        $roles->update([
            'name' => $request->get('name') ,
            'abilities' => $request->get('abilities'),
            'admin_data' => auth()->user(),
        ]);
        return redirect(route('roles.index'))->with('success' , 'Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('roles.delete');
        $roles = Role::findOrFail($id);
        $this->authorize('delete' , $roles);
        $roles->delete();
        return redirect(route('roles.index'))->with('success' , 'Role Deleted');
    }
}
