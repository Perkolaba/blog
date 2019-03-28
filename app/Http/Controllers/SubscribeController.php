<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{

    public function subscribe(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions'
        ]);

        $sub = Subscription::add($request->get('email'));
        $sub->generateToken();

        Mail::to($sub)->send(new SubscribeEmail($sub));

        return redirect()->back()->with('status', 'Проверьте Вашу почту!');
    }

    public function verify($token) {

        $subs = Subscription::where('token', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();
        return redirect('/')->with('status', 'Ваша почта подтверждена! Спасибо :)');

    }

}
