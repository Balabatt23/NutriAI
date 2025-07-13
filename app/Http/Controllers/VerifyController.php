<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpEmail;
use Illuminate\Http\Request;
use App\Models\Verifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    public function index()
    {
        return view('verifications.index');
    }

    public function store(Request $request)
    {
        if($request->type == 'register') {
            $user = User::find($request->user()->id);
        }else {

        }
        if(!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $otp = rand(100000, 999999);
        $verify = Verifications::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => $request->type,
            'send_via' => 'email',
        ]);
        Mail::to($user->email)->queue(new OtpEmail($otp));
        if($request->type == 'register') {
            return redirect('/verify/' . $verify->unique_id);
        }
        return redirect('/reset-password');
    }

    public function show($unique_id)
    {
        $verification = Verifications::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)->whereStatus('active')->count();
        if(!$verification) {
            return redirect()->back()->with('error', 'Verification not found.');
        }
        return view('verifications.show', compact('unique_id'));
    }

    public function verify(Request $request, $unique_id)
    {
        $verification = Verifications::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)->whereStatus('active')->first();
        if(!$verification) {
            return redirect()->back()->with('error', 'Verification not found.');
        }
        if(md5($request->otp) !== $verification->otp) {
            $verification->update(['status' => 'invalid']);
            return redirect('/verify');
        }
        $verification->update(['status' => 'valid']);
        User::find($verification->user_id)->update(['status'=>'active']);

        return redirect('/dashboard')->with('success', 'Verification successful.');
    }
}
