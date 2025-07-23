<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DailyCalorie;
use App\Models\DailyConsumption;
use App\Models\BodyWeightHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

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
        try {
            $field = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

<<<<<<< HEAD
                if(!Auth::attempt($field)){
                    throw new \Exception ('Wrong email or password');
                }

                $request->session()->regenerate();

                
                $user = Auth::user();

                // dd($user, $user->daily_calorie()->whereDate('created_at', Carbon::today())->exists());

        

            $request->session()->regenerate();
            $user = Auth::user();

            // Cek apakah sudah ada daily calorie hari ini
            if (!$user->daily_calorie()->whereDate('created_at', Carbon::today())->exists()) {
                $calorie_intake = match (true) {
                    $user->age < 14 => 1800,
                    $user->age <= 18 => 2200,
                    $user->age <= 20 => 2500,
                    $user->age <= 32 => 2900,
                    $user->age <= 50 => 2500,
                    default => 2000,
                };

                if ($user->gender === 'F') {
                    $calorie_intake -= 400;
                }

                $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', [
                    'weight' => $user->weight,
                    'height' => $user->height,
                    'bmi' => $user->bmi,
                    'gender' => $user->gender === 'F' ? 1 : 0,
                    'excercise_frequency' => $user->exercise_frequency,
                    'age' => $user->age,
                    'caloric_intake' => $calorie_intake,
                    'daily_steps' => $user->avg_daily_steps,
                    'avg_sleep_hours' => $user->avg_sleep_hours,
                    'alcohol_consumption' => $user->alcohol_consumption,
                    'smoking_habit' => $user->smoking_habit
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

=======
            if (!Auth::attempt($field)) {
                throw new \Exception('Wrong email or password');
            }

            $request->session()->regenerate();
            $user = Auth::user();

            // Cek apakah sudah ada daily calorie hari ini
            if (!$user->daily_calorie()->whereDate('created_at', Carbon::today())->exists()) {
                $calorie_intake = match (true) {
                    $user->age < 14 => 1800,
                    $user->age <= 18 => 2200,
                    $user->age <= 20 => 2500,
                    $user->age <= 32 => 2900,
                    $user->age <= 50 => 2500,
                    default => 2000,
                };

                if ($user->gender === 'F') {
                    $calorie_intake -= 400;
                }

                $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', [
                    'weight' => $user->weight,
                    'height' => $user->height,
                    'bmi' => $user->bmi,
                    'gender' => $user->gender === 'F' ? 1 : 0,
                    'excercise_frequency' => $user->exercise_frequency,
                    'age' => $user->age,
                    'caloric_intake' => $calorie_intake,
                    'daily_steps' => $user->avg_daily_steps,
                    'avg_sleep_hours' => $user->avg_sleep_hours,
                    'alcohol_consumption' => $user->alcohol_consumption,
                    'smoking_habit' => $user->smoking_habit
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function google_redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback() {
        $googleUser = Socialite::driver('google')->user();
        $user = User::whereEmail($googleUser->email)->first();
        if(!$user) {
            $user = User::create([
                'username' => $googleUser->name,
                'email' => $googleUser->email,
                'status' => 'active'
            ]);
        }
        if($user && $user->status == 'verify') {
            $user->update(['status' => 'active']);
        }
        if($user && $user->status == 'banned') {
            return redirect()->route('login')->with('failed', 'Akun anda telah diblokir');
        }
        Auth::login($user);
        return redirect()->route('dashboard');
    }
>>>>>>> 33e8f1f0ab7d5704957f7a74de030aeaf1723ea8

    // public function testing_model()
    // {
    //     try{
    //         $user = Auth::user();
            
    //         $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', [
    //             'weight' => 80,
    //             'height' => 174,
    //             'bmi' => 26.4,
    //             'gender' => 0,
    //             'exercise_frequency' => 5,
    //             'age' => 20,
    //             'caloric_intake' => 2000,
    //             'daily_steps' => 7000,
    //             'avg_sleep_hours' => 6.5,
    //             'alcohol_consumption' => 0,
    //             'smoking_habit' => 0,
    //         ]);
    //         $result = $response->json();
        
    //         return response()->json([
    //             'status' => true, 
    //             'result' => $result
    //         ]);
    //     }catch(\Exception $e){
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

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
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'exercise_frequency' => 'required|numeric|max:7|min:-1',
            'avg_sleep_hours' => 'required|numeric',
            'avg_daily_steps' => 'required|numeric',
            'alcohol_consumption' => 'nullable|boolean',
            'smoking_habit' => 'nullable|boolean',
        ]);

        $field['bmi'] = $field['weight'] / ($field['height'] * $field['height'] / 10000);
        $field['status'] = 'verify';
        $field['alcohol_consumption'] = $request->has('alcohol_consumption');
        $field['smoking_habit'] = $request->has('smoking_habit');


        Auth::attempt([
            'username' => $field['username'],
            'password' => $request->input('password')
        ]);

        $request->session()->regenerate();

        $user = Auth::user();

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

            // $response = Http::post('http://127.0.0.1:5000/get_recom_calorie', 
            dd([
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
            // );

            $result = $response->json();

            dd($result);

            $user->daily_calorie()->create([
                'calories_in' => 0,
                'calories_out' => 0,
                'recommended_calories' => $result['result'],
                // 'user_id' => $user->id
            ]);
        }

        // return $this->login($request);
        // Auth::login($user);
        return redirect('/dashboard');
        }catch(\Exception $e){
            dd($e->getMessage());
        }
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
                'age',
                'exercise_frequency',
                'avg_sleep_hours',
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
