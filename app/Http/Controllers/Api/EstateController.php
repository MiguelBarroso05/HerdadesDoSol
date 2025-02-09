<?php

namespace App\Http\Controllers\Api;

use App\Models\Estate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index()
    {
        $estates = Estate::all();
        return response()->json(['estates' => $estates]);
    }
}
