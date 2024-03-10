<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserAdminController extends Controller {
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $users = User::all();
        
                return view('admin.users.index', compact('users'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                return view('admin.users.create');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateUser($request);

                $user = new User([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'phone' => $request->phone,
                    'country' => $request->country,
                    'city' => $request->city,
                    'zip_code' => $request->zip_code,
                    'admin' => $request->admin,
                ]);

                $user->save();

                return redirect()->route('admin.users.index');       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $user = User::findOrFail($id);

                return view('admin.users.edit', compact('user'));       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateUser($request);

                $user = User::findOrFail($id);
                $user->update($request->all());
                $user->save();

                return redirect()->route('admin.users.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $user = User::findOrFail($id);
                $user->delete();

                return redirect()->route('admin.users.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    private function validateUser(Request $request) {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'phone' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'admin' => 'required|boolean',
        ];

        $request->validate($rules);
    }
}