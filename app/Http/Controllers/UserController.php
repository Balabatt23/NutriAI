<?php

namespace App\Http\Controllers;

use App\Models\BodyWeightHistory;
use App\Models\DailyCalorie;
use App\Models\DailyConsumption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function user_check()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }
    
    public function profile_page()
    {
        return view('profile', [
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
        $today = Carbon::today();

        // dd($today, DailyConsumption::all());

        $meals = $user->daily_consumption()->whereDate('created_at', $today)->get();

        $day_calories_total = $user->daily_consumption()->sum('calories');
        $day_max_calories = $user->daily_calorie()->whereDate('created_at', $today)->first();

        return view('dashboard', [
            'meals' => $meals,
            'day_calorie' => $day_calories_total,
            'max_calorie' => $day_max_calories
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

            
            $user = Auth::user();

            // dd($user);            
            if(!$user->daily_calorie()->whereDate('created_at', Carbon::today())->exists()){
                
                $calorie_intake;

                $age = $user->age;

                if($age < 14) $calorie_intake = 1800;
                elseif($age > 14 && $age <= 18) $calorie_intake = 2200;
                elseif($age > 18 && $age <= 20) $calorie_intake = 2500;
                elseif($age > 20 && $age <= 32) $calorie_intake = 2900;
                elseif($age > 32 && $age <= 50) $calorie_intake = 2500;
                elseif($age > 50) $calorie_intake = 2000;

                if($user->gender === 'F') $calorie_intake -= 400;

                $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', [
                    'weight' => $user['weight'],
                    'height' => $user['height'],
                    'bmi' => $user['bmi'],
                    'gender' => $user['gender'] === 'F' ? 1 : 0,
                    'excercise_frequency' => $user['exercise_frequency'],
                    'age' => $user['age'],
                    'caloric_intake' => $calorie_intake,
                    'daily_steps' => $user['avg_daily_steps'],
                    'avg_sleep_hours' => $user['avg_sleep_hours'],
                    'alcohol_consumption' => $user['alcohol_consumption'],
                    'smoking_habit' => $user['smoking_habit']
                ]);

                $result = $response->json();
                
                DailyCalorie::create([
                    'calories_in' => 0,
                    'calories_out' => 0,
                    'recommended_calories' => $result['result'],
                    'user_id' => $user->id
                ]);
            }

            return redirect()->intended('/dashboard');            

        }catch(\Exception $e){

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function testing_model()
    {
        try{
            $user = Auth::user();
            
            $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', [
                'weight' => 80,
                'height' => 174,
                'bmi' => 26.4,
                'gender' => 0,
                'exercise_frequency' => 5,
                'age' => 20,
                'caloric_intake' => 2000,
                'daily_steps' => 7000,
                'avg_sleep_hours' => 6.5,
                'alcohol_consumption' => 0,
                'smoking_habit' => 0,
            ]);
            $result = $response->json();
        
            return response()->json([
                'status' => true, 
                'result' => $result
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
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
        $field = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'exercise_frequency' => 'required|numeric|max:7|min:-1',
            'avg_sleep_hours' => 'required|numeric',
            'avg_daily_steps' => 'required|numeric'
        ]);

        $field['bmi'] = $field['weight'] / ($field['height'] * $field['height'] / 10000);

        $field['status'] = 'verify';

        $user = User::create($field);

        // return $this->login($request);
        // Auth::login($user);
        return redirect('/login');
    }

    public function update(Request $request)
    {
        try{
                
            $field = $request->validate([
                'weight',
                'height',
                'weight_target',
                'gender',
                'birth_date',
                'bmi', 
                'exercise_frequency',
                'avg_sleep_hours',
                'blood_pressure_systolic',
                'blood_pressure_diastolic',
                'alcohol_consumption',
                'smoking_habit'
            ]);

            $user = Auth::user();

            $field['BMI'] = $field['weight'] / (($field['height'] * $field['height']) / 10000);

            $user->update($field);

            BodyWeightHistory::create([
                'user_id' => $user->id,
                'weight' => $field['weight']
            ]);        

            return redirect()->back()->with('success', 'Berhasil mengubah profile anda!');

        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Ada kesalahan dalam mengubah profile anda: '. $e->getMessage());
        }
    }

    public function update_profile_pic(Request $request)
    {

    }

    public function delete(User $user)
    {
        
    }
}
