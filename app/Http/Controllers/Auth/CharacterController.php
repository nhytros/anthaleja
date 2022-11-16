<?php

namespace App\Http\Controllers\Auth;

use Faker\Factory;
use Illuminate\Http\Request;
use App\Models\Auth\Character;
use App\Http\Controllers\Controller;

class CharacterController extends Controller
{
    private $faker;
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uid)
    {
        $this->validate($request, [
            'first_name' => ['required', 'max:48'],
            'last_name' => ['required', 'max:48'],
            'username' => ['required'],
            'height' => ['required', 'min:150', 'max:220'],
            'date_of_birth' => ['required'],
        ]);

        $faker = $this->faker;
        $character = Character::create([
            'user_id' => $uid,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'gender' => $request->gender ?? 'n/a',
            'height' => $request->height,
            'date_of_birth' => $request->date_of_birth,
            'bank_account' => 'ATH-' . $faker->unique()->numberBetween(10000000, 39999999),
            'has_phone' => true,
            'phone_no' => $faker->unique()->numerify('###-####'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Trash the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function delete(Character $character)
    {
        //
    }

    /**
     * Restore the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function restore(Character $character)
    {
        //
    }

    /**
     * Remove permanently the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}
