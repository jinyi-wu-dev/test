<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return $this->localeView("front/%s/contact");
    }

    public function do(Request $request)
    {
    }

}
