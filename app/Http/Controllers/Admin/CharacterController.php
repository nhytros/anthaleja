<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Models\Auth\Character;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CharacterStoreRequest;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.characters.index', [
            'title' => __('Characters Management'),
            'characters' => Character::withTrashed()->with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new character.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.characters.manage', [
            'character' => null,
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created character.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterStoreRequest $request)
    {
        $faker = Faker::create();

        Character::create([
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'gender' => $request->gender,
            'height' => $request->height,
            'date_of_birth' => $request->date_of_birth,
            // TODO: Upload avatar
            'bank_account' => 'ATH-' . $faker->numberBetween(1000000, 3999999),
            'bank_amount' => 500,
            'cash' => 0,
            'metals' => 0,
            'has_phone' => true,
            'phone_no' => $faker->numerify('888-####'),
            'avatar' => null,
            'thirst' => 0,
            'hunger' => 0,
            'energy' => 100,

            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.characters')->withSuccess(trans('admin.character.created'));
    }

    /**
     * Display the specified character.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
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
        return view('admin.characters.manage', [
            'title' => __('Edit Character'),
            'character' => Character::withTrashed()->where('username', $username)->firstOrFail(),
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
        $character = Character::where('username', $username)->firstOrFail();
        $request->validate([
            'username' => ['required', 'unique:characters,username,' . $character->id],
            'email' => ['required', 'email', 'unique:characters,email,' . $character->id],
        ]);

        $character->update([
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status == 'on' ? 1 : 0,
        ]);
        return Redirect::route('admin.characters')->withSuccess(trans('admin.character.updated'));
    }

    public function filterByRole($role)
    {
    }

    /**
     * Remove temporarily the specified character.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function delete($username)
    {
        $character = Character::where('username', $username)->firstOrFail();
        if ($character->hasRole('admin')) {
            return back()->withDanger(trans('admin.character.no_delete_admin_character'));
        }
        $character->delete();
        return back()->withSuccess(trans('admin.character.deleted'));
    }

    /**
     * Restore the specified character.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function restore($username)
    {
        $character = Character::withTrashed()->where('username', $username)->first();
        $character->restore();
        return back()->withSuccess(trans('admin.characters.restored'));
    }

    /**
     * Remove permanently the specified character.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $character = Character::withTrashed()->where('username', $username)->first();
        // TODO: Remove avatar
        $character->forceDelete();
        return back()->withSuccess(trans('admin.characters.destroyed'));
    }
}
