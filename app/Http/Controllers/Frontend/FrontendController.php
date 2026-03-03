<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $agencies = \App\Models\Agency::select('name', 'subdomain')->get();
        return view('frontend.index', compact('agencies'));
    }
}
