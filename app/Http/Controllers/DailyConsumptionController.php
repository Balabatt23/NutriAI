<?php

namespace App\Http\Controllers;

use App\Models\DailyConsumption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DailyConsumptionController extends Controller
{

    public function todayMeals() {
        $meals = DailyConsumption::whereDate('created_at', now()->toDateString())->get();

        return response()->json([
            'status' => true,
            'meals' => $meals
        ]);
    }

    public function get_by_date(Request $request)
    {
        $field = $request->validate([
            'date' => 'required|date'
        ]);

        $user = Auth::user();

        $daily_consumption = $user->daily_consumption()->whereDate('created_at', $field['date'])->get();

        return response()->json([
            'status' => true,
            'datas' => $daily_consumption
        ]);

    }

    public function create(Request $request)
    {
        try{
            $field = $request->validate([
                'food_name' => 'required',
                'calories' => 'required',
                'protein' => 'nullable|numeric|min:0',
                'carbs' => 'nullable|numeric|min:0',
                'meal_type' => 'nullable|string|in:breakfast,lunch,dinner,snack'
            ]);

            // dd($request->all());

            if(!$field['calories']){
                $response = Http::post('http://127.0.0.1:5000/get_by_name', [
                    'food_name' => $field['food_name']
                ]);

                $results = $response->json();
                // return response()->json([
                //     'result' => $results
                // ]);

                $user = Auth::user();                
                $daily_calorie = $user->daily_calorie()->whereDate('created_at', Carbon::today())->first();
                $datas = [];
                $calorie_total = 0;
                $now = now();

                foreach($results as $result) {
                    $datas[] = [
                        'food_name' => $result->nama,
                        'calories' => $result->kalori,
                        'user_id' => $user->id,
                        'created_at' => $now
                    ];

                    $calorie_total += $result->kalori;
                }
                
                DailyConsumption::insert($datas);

                $daily_calorie->calories_in += $calorie_total;
                $daily_calorie->save();
                

                return redirect()->back();
            }

            $field['user_id'] = Auth::user()->id;
            $field['date'] = Carbon::now()->format('Y-m-d');

            $data = DailyConsumption::create($field);

            return response()->json([
                'status' => true, 
                'message' => 'berhasil menambahkan daily meal.',
                'data' => $data
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create_by_pic(Request $request)
    {
        try{
            
            $request->validate([
                'file' => 'required|image|max:10240'
            ]);

            $gambar = $request->file('file');

            $response = Http::attach(
                'file',
                fopen($gambar->getPathname(), 'r'),
                $gambar->getClientOriginalName()
            )->post('http://127.0.0.1:5000/get_by_pic');

            $user = Auth::user();

            $datas = [];

            $timestamps = Carbon::now();

            $results = $response->json();

            if(!$results[0] || $results[0]['status'] || !$results[0]['kalori'] || !$results[0]['nama']) throw new \Exception('Tidak ada makanan di dalam foto!');
            

            foreach($response->json() as $result){
                $datas[] = [
                    'food_name' => $result['nama'],
                    'calories' => $result['kalori'] ?? false,
                    'user_id' => $user->id,
                    'created_at' => $timestamps,
                    'updated_at' => $timestamps
                ];
            }

            DailyConsumption::insert($datas);

            return response()->json([
                'success' => true,
                'data' => $response->json()[0] ?? []
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
     public function delete(Request $request, $id)
    {
        try {
            $meal = DailyConsumption::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail();

            $meal->delete();

            return response()->json([
                'status' => true,
                'message' => 'Makanan berhasil dihapus.',
                'data' => $meal
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting meal: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus makanan: ' . $e->getMessage()
            ], 500);
        }
    }
}
