<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AdminController extends Controller {
    public function home() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                return view('admin.home');
            }
        } else {
            return redirect()->route('login');
        }
    }
}