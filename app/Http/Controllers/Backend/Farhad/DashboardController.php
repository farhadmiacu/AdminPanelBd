<?php

namespace App\Http\Controllers\Backend\Farhad;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:dashboard_view')->only(['index']);
    }

    public function index()
    {
        return view('backend.master');
    }
}
