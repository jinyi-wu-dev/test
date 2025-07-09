<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        return $this->languageView('index');
    }

}
