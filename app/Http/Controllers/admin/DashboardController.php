<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\adminMiddleware;
use Auth;
use App\User;
class DashboardController extends Controller
{
    public function index() {
    	//dd(Auth::user());
        return view("admin.dashboard");
    }
}
