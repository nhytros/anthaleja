<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username = null)
    {
        $users = User::withTrashed()->with('characters')->get();
        return view('admin.users.index', [
            'title' => __('Users Management'),
            'users' => $users,
            'user' => $username ? User::withTrashed()->where('username', $username)->firstOrFail() : false,
            'roles' => Role::all(),
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
        $request->validate([
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'status' => $request->status ? true : false,
        ])->assignRole('user');
        return Redirect::route('admin.users')->withSuccess(trans('admin.user.created'));
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
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $users = User::withTrashed()->with('characters')->get();
        return view('admin.users.index', [
            'title' => __('Users Management'),
            'users' => $users,
            'user' => User::withTrashed()->where('username', $username)->firstOrFail(),
            'roles' => $username ? Role::all() : false,
            'permissions' => $username ? Permission::all() : false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        // dd($request);
        $user = User::where('username', $username)->firstOrFail();
        $request->validate([
            'username' => ['required', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => [
                'nullable', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'status' => $request->status == 'on' ? 1 : 0,
        ]);
        return Redirect::route('admin.users')->withSuccess(trans('admin.user.updated'));
    }

    /**
     * Assign role to the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $user->assignRole($request->role);
        return Redirect::back()->withSuccess(trans('admin.user.role_assigned'));
    }

    /**
     * Revoke permission for the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function removeRole(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $user->removeRole($request->role);
        return Redirect::back()->withSuccess(trans('admin.user.role_removed'));
    }

    /**
     * Give permission to the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function givePermission(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $user->givePermissionTo($request->permission);
        return Redirect::back()->withSuccess(trans('admin.user.permission_assigned'));
    }

    /**
     * Revoke permission for the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function removePermission(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        $user->revokePermissionTo($request->permission);
        return Redirect::back()->withSuccess(trans('admin.user.permission_removed'));
    }

    public function filterByRole($role)
    {
        $users = User::withTrashed()->with('characters')->role($role)->get();
        $username = null;
        return view('admin.users.index', [
            'title' => __('Users Management'),
            'users' => $users,
            'user' => $username ? User::withTrashed()->where('username', $username)->firstOrFail() : false,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Remove temporarily the specified user.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function delete($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if ($user->hasRole('admin')) {
            return back()->withDanger(trans('admin.user.no_delete_admin_user'));
        }
        $user->delete();
        return back()->withSuccess(trans('admin.user.deleted'));
    }

    /**
     * Restore the specified user.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function restore($username)
    {
        $user = User::withTrashed()->where('username', $username)->first();
        $user->restore();
        return back()->withSuccess(trans('admin.users.restored'));
    }

    /**
     * Remove permanently the specified user.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $user = User::withTrashed()->where('username', $username)->first();
        // TODO: Remove avatar
        $user->forceDelete();
        return back()->withSuccess(trans('admin.users.destroyed'));
    }
}
