<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class SignupController extends Controller
{
    protected function rules($confirm=false) {
        return [
            'name' => 'required',
            'kana' => 'required',
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
            'email' => $confirm ? ['required','confirmed'] : 'required',
            'password' => $confirm ? ['required','confirmed'] : 'required',
            'agree' => $confirm ? 'required' : '',
        ];
    }

    public function index()
    {
        return $this->languageView("signup");
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(true));
        return $this->languageView("signup_confirm");
    }

    public function complete(Request $request)
    {
        $v = Validator::make($request->all(), $this->rules(false));
        if ($v->fails() || $request->back) {
            dd($v);
            return redirect()->route('signup')->withInput();
        }

        $user = new User($request->all());
        $user->save();

        return $this->languageView("signup_complete");
    }

}
