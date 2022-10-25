<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a list of users. (admin & staff only)
     *
     */
    // public function list()
    // {
    //     if(Auth::user()->can('users.list'))
    //     //
    // }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified user.
     * admin or staff: can update any settings
     * user:  can update only own settings
     *
     * @param  string $username
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $cuser = Auth::user();
        $user = User::where('username', $username)->first;
        $admin = ($cuser->type == 'admin' || $cuser->type == 'staff') ? true : false;
        $title = $admin ? 'Manage User Profile' : 'Manage Profile';
        return view('user.frontier.user_manage', compact('admin', 'user', 'title'));
    }

    /**
     * Update the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //     if(Auth::user()->can('users.update'))
        //
    }

    /**
     * Disable the specified user (admin & staff only).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //     if(Auth::user()->can('users.delete'))
        //
    }

    /**
     * Restore the specified user (admin & staff only).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //     if(Auth::user()->can('users.restore'))
        //
    }

    /**
     * Remove permanently the specified user (admin only).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //     if(Auth::user()->can('users.destroy'))
        //
    }
}
