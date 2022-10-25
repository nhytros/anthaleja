<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $permissions = Permission::withTrashed()->orderBy('priority', 'asc')->get();
        return view('admin.permissions.index', [
            'title' => __('Permissions Management'),
            'permissions' => $permissions,
            'permission' => $slug ? Permission::withTrashed()->where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $request->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'priority' => $request->priority,
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.permissions')->withSuccess(trans('admin.permissions.created'));
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $permissions = Permission::withTrashed()->orderBy('priority', 'asc')->get();
        return view('admin.permissions.index', [
            'title' => __('Permissions Management'),
            'roles' => Role::all(),
            'permissions' => $permissions,
            'permission' => Permission::withTrashed()->where('slug', $slug)->firstOrFail(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $request->validate([
            'name' => 'required', ['unique:roles,name', $permission->id],
        ]);

        $permission->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'priority' => $request->priority,
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.permissions')->withSuccess(trans('admin.permissions.updated'));
    }

    /**
     * Assign role to the specified permission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request, $slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        if ($permission->hasRole($request->role)) {
            return back()->withWarning(trans('admin.permission.role.already_set'));
        }
        $permission->assignRole($request->role);
        return back()->withSuccess(trans('admin.permission.role.assigned', [
            'pname' => $permission->name,
            'rname' => $request->role,
        ]));
    }

    /**
     * Remove role for the specified permission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function removeRole(Request $request, $pslug, $rslug)
    {
        $permission = Permission::where('slug', $pslug)->first();
        $role = Role::where('slug', $rslug)->first();
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->withWarning(trans('admin.permission.role.removed'));
        }
        return back()->withDanger(trans('admin.permission.role.not_exist'));
    }

    /**
     * Remove temporarily the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function delete($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        $permission->delete();
        return back()->withSuccess(trans('admin.permissions.deleted'));
    }

    /**
     * Restore the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $permission = Permission::withTrashed()->where('slug', $slug)->first();
        $permission->restore();
        return back()->withSuccess(trans('admin.permissions.restored'));
    }

    /**
     * Remove permanently the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $permission = Permission::withTrashed()->where('slug', $slug)->first();
        $permission->forceDelete();
        return back()->withSuccess(trans('admin.permissions.destroyed'));
    }
}
