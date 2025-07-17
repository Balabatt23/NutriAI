<?php

namespace App\Http\Controllers;

use App\Models\DailyConsumption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function user_check()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }
    
    public function viewLogin() {
        return view('auth.login');
    }

    public function viewRegister() {
        return view('auth.registrasi');
    }
    
    public function dashboard()
    {
        $user = Auth::user();

        $meals = $user->daily_consumption()->whereDate('created_at', Carbon::today())->get();

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
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $request['status'] = 'verify';

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);
        Auth::login($user);
        return redirect('/dashboard');
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
