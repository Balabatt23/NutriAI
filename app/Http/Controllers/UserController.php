<?php

namespace App\Http\Controllers;

use App\Models\DailyConsumption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $meals = $user->daily_consumption;

        $day_calories_total = $user->daily_consumption()->sum('calories');

        return view('dashboard', [
            'meals' => $meals,
            'day_calorie' => $day_calories_total
        ]);
    }

    public function login(Request $request)
    {
        try{
            
            $field = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if(!Auth::attempt($field)){
                throw new \Exception ('Wrong email or password');
            }

            

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');            

        }catch(\Exception $e){
            dd($e);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'berhasil logout');
    }

    public function create(Request $request)
    {
        try{
            $field = $request->validate([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            
            $password = $field['password'];

            $field['password'] = Hash::make($field['password']);

            $new_user = User::create($field);

            $user_login = [
                'email' => $new_user->email,
                'password' => $password
            ];

            if(!Auth::attempt($user_login)){
                throw new \Exception ('Wrong email or password');
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); 

        }catch(\Exception $e){

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $field = $request->validate([

        ]);
    }

    public function delete(User $user)
    {
        
    }
}
