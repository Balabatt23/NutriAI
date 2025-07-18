<?php

namespace App\Http\Controllers;

use App\Models\DailyConsumption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DailyConsumptionController extends Controller
{
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
            )->post('http://127.0.0.1:5000/gemini_api');
                
            $user_id = Auth::user()->id;

            $datas = [];

            $timestamps = Carbon::now();

            foreach($response->json() as $result){
                $datas[] = [
                    'food_name' => $result['nama'],
                    'calories' => $result['kalori'],
                    'user_id' => $user_id,
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
