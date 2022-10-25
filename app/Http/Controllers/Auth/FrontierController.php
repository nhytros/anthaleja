<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\{Auth, Hash, Redirect, Session};

class FrontierController extends Controller
{
    /**
     * Check credentials and allow (or not) the user to login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if ($user->status == 0 || $user->deleted_at != null) {
                return back()->withErrors('User temporarely disabled. Please contact administrators.');
            } elseif (!Hash::check($request->password, $user->password, ['rounds' => 12])) {
                return back()->onlyInput('username')->withErrors('Invalid password.');
            } elseif (Auth::attempt([
                'username' => $request->username,
                'password' => $request->password,
            ], $request->remember)) {
                // self::preLogin($request, $user);
                if ($user->hasRole('admin')) {
                    return Redirect::route('admin.dashboard')->withSuccess('Welcome to Anthalys, Admin!');
                } elseif ($user->hasRole('vendor')) {
                    return Redirect::route('home')->withSuccess('Welcome to Anthalys, Vendor!');
                    // die('welcome vendor');
                } else {
                    return Redirect::route('home')->withSuccess('Welcome to Anthalys!');
                }
            }
        } else {
            return back()->withErrors('This user does not exist. Please contact administrator.');
        }
    }

    /**
     * Store a newly registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'unique:users,username'],
            'password' => [
                'required', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password, ['rounds' => 12]),
        ]);
        if ($request->character) {
            $message = 'User has been created. Now you can create your first character';
            // Create a character
        } else {
            $message = 'User has been created. Remember to create your first character';
            return redirect('home')
                ->withWarning($message);
        }
    }

    /**
     * Logout the current user
     * @return void
     */
    public function logout()
    {
        $user = User::find(Auth::id());
        // $total_time = $user->total_time ?? 0;
        // $total_time += (time() - $user->last_login);
        // $user->update([
        //     'last_logout' => time(),
        //     'total_time' => $total_time,
        // ]);
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/frontier')
            ->withInfo('Logout successful');
    }

    private function preLogin($request, $user)
    {
        $request->session()->regenerate();
        $user->last_login = time();
        $user->save();
    }
}
