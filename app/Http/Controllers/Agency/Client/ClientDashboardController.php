<?php

namespace App\Http\Controllers\Agency\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function index()
    {
        return view('client.dashboard.index');
    }
}
