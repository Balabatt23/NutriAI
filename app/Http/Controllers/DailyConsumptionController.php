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
                'calories' => 'required'
            ]);

            $field['user_id'] = Auth::user()->id;

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
                'file' => 'required'
            ]);

            $gambar = $request->file('file');

            $response = Http::attach('file', 
                fopen($gambar->getPathname(), 'r',
                $gambar->getClientOriginalName())
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
                'result' => $response->json()
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
        return response()->json([
            'status' => 'berhasil'
        ]);
    }
}
