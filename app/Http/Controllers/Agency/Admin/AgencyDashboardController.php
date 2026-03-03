<?php

namespace App\Http\Controllers\Agency\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyDashboardController extends Controller
{
    public function index()
    {
        $agency = request()->attributes->get('agency');

        return view('agency.admin.dashboard', compact('agency'));
    }
}
