<?php

namespace App\Http\Controllers\Backend\Farhad;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.master');
    }
}
