<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        return $this->languageView("signup");
    }

    protected function validate(Request $request, $confirm=false) {
        $request->validate([
            'name1' => 'required',
            'name2' => 'required',
            'kana1' => 'required',
            'kana2' => 'required',
            'postal_code' => 'required',
            'prefecture' => 'required',
            'country' => 'required_if:prefecture,foreign',
            'city' => 'required',
            'area' => 'required',
            'building' => 'required',
            'phone_number' => 'required',
            'company' => 'required',
            'department' => 'required',
            'positions' => 'required',
            'industries' => 'required',
            'occupationes' => 'required',
            'email' => ['required','confirmed'],
            'password' => ['required','confirmed'],
            'agree' => 'required',
        ]);
    }

    public function confirm(Request $request)
    {
        $this->validate($request);

        return $this->languageView("signup_confirm");
    }

    public function complete(Request $request)
    {
        $this->validate($request);
        if ($request->back) {
            return redirect()->route('signup')->withInput();
        }

        $user = new User($request->all());
        $user->name = $request->name1 . $request->name2;
        $user->kana = $request->kana1 . $request->kana2;
        $user->save();

        return $this->languageView("signup_complete");
    }

}
