<?php

namespace App\Http\Controllers\Agency\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyCandidateController extends Controller
{
    public function index()
    {
        $agency = request()->attributes->get('agency');
        $candidates = $agency->candidates()->get(); // assuming agency hasMany candidates
        return view('agency.candidate.index', compact('candidates'));
    }
}
