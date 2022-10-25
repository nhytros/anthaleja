<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Role;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $roles = Role::withTrashed()->orderBy('priority', 'asc')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', [
            'title' => __('Roles Management'),
            'permissions' => $permissions,
            'roles' => $roles,
            'role' => $slug ? Role::withTrashed()->where('slug', $slug)->firstOrFail() : false,
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
        $role = $request->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'priority' => $request->priority,
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.roles')->withSuccess(trans('admin.role.created'));
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
        $roles = Role::withTrashed()->orderBy('priority', 'asc')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', [
            'title' => __('Roles Management'),
            'permissions' => $permissions,
            'roles' => $roles,
            'role' => Role::withTrashed()->where('slug', $slug)->firstOrFail(),
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
        $role = Role::where('slug', $slug)->first();
        $request->validate([
            'name' => 'required', ['unique:roles,name', $role->id],
        ]);

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'priority' => $request->priority,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.roles')->withSuccess(trans('admin.role.updated'));
    }

    /**
     * Assign permission to the specified role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function givePermission(Request $request, $slug)
    {
        $role = Role::where('slug', $slug)->first();
        if ($role->hasPermissionto($request->permission)) {
            return back()->withWarning(trans('admin.roles.permissions.already_set'));
        }
        $role->givePermissionTo($request->permission);
        return back()->withSuccess(trans('admin.roles.permissions.granted', ['name' => $role->name]));
    }

    /**
     * Revoke permission for the specified role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function revokePermission(Request $request, $rslug, $pslug)
    {
        $role = Role::where('slug', $rslug)->first();
        $permission = Permission::where('slug', $pslug)->first();
        if ($role->hasPermissionto($permission)) {
            $role->revokePermissionTo($permission);
            return back()->withWarning(trans('admin.roles.permissions.revoked'));
        }
        return back()->withDanger(trans('admin.roles.permissions.not_exist'));
    }

    /**
     * Remove temporarily the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function delete($slug)
    {
        if ($slug == 'admin') {
            return back()->withDanger(trans('admin.role.no_delete_admin_role'));
        }
        $role = Role::where('slug', $slug)->first();
        $role->delete();
        return back()->withSuccess(trans('admin.role.deleted'));
    }

    /**
     * Restore the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $role = Role::withTrashed()->where('slug', $slug)->first();
        $role->restore();
        return back()->withSuccess(trans('admin.role.restored'));
    }

    /**
     * Remove permanently the specified role.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $role = Role::withTrashed()->where('slug', $slug)->first();
        $role->forceDelete();
        return back()->withSuccess(trans('admin.role.destroyed'));
    }
}
