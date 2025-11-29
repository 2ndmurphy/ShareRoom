<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $rooms = auth()->user()->roomsAsMentor;
        return view('mentor.dashboard', compact('rooms'));
    }
}
