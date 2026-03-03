<?php

namespace App\Http\Controllers\Agency\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyClientController extends Controller
{
    public function index()
    {
        $agency = request()->attributes->get('agency');
        $clients = $agency->clients()->get(); // assuming agency hasMany clients
        return view('agency.clients.index', compact('clients'));
    }
}
