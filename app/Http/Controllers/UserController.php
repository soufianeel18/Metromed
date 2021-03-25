<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UserController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$this->authorize('viewAny', \App\User::class);

        if(auth()->user()->role == 'chef technicien') {
            $users = User::where('role', '=', 'technicien')->get();
        }

        if(auth()->user()->role == 'chef commercial') {
            $users = User::where('role', '=', 'commercial')->get();
        }

        if(auth()->user()->role == 'chef stock') {
            $users = User::where('role', '=', 'agent stock')->get();
        }

        if(auth()->user()->role == 'admin') {
            $users = User::where('role', '!=', 'admin')->get();
        }

    	return view('users.index', compact('users'));
    }

    public function history(User $user) {
        $this->authorize('viewHistory', $user);

        $events = collect($user->events)->sortByDesc('date');

        return view('users.history', compact('user', 'events'));
    }

    public function create() {
        $this->authorize('create', \App\User::class);

        return view('users.create');
    }

    public function store() {
        $this->authorize('create', \App\User::class);

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:8|string|confirmed',
            'role' => 'nullable',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'username' => $data['username'],
            'color' => '#' . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)),
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'date_cnx' => \Carbon\Carbon::now(),
        ]);

        return redirect('/user');
    }

    public function edit(User $user) {
    	$this->authorize('update', $user);

    	return view('users.edit', compact('user'));
    }

    public function editPassword(User $user) {
        $this->authorize('update', $user);

        return view('users.edit_password', compact('user'));
    }

    public function editRole(User $user) {
        $this->authorize('updateRole', $user);

        if(auth()->user()->role == 'admin') {
            return view('users.edit_admin_role', compact('user'));
        } else {
            return view('users.edit_role', compact('user'));
        }
    }

    public function update(User $user) {
    	$this->authorize('update', $user);

    	$data = request()->validate([
    		'name' => 'required|string',
    		'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'color' => 'required|unique:users,color,' . $user->id,
    	]);
    	
    	$user->update($data);

        if(auth()->user()->id == $user->id) {
            return redirect('/home');
        }

    	return redirect('/user');
    }

    public function updatePassword(User $user) {
        $this->authorize('update', $user);

        $password = $user->password;

        $data = request()->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|string|different:old_password|confirmed',
            'password_confirmation' => 'required',
        ]);

        if(!Hash::check($data['old_password'], $password)) {
            $message = 'L ancien mot de passe est incorrecte.';
            $adresse = '/user/' . $user->id . '/password/edit';
            return view('users.alert', compact('message', 'adresse'));
        }

        $user->password = Hash::make($data['password']);
        $user->update();

        if(auth()->user()->id == $user->id) {
            return redirect('/home');
        }

        return redirect('/user');
    }

    public function updateRole(User $user) {
        $this->authorize('updateRole', $user);

        $data = request()->validate([
            'role' => 'required',
        ]);

        $user->role = $data['role'];
        $user->update();

        return redirect('/user');
    }

    public function destroy(User $user) {
        $this->authorize('delete', $user);

        if(auth()->user()->id == $user->id) {
            $user->delete();
            return redirect('/home');
        }

        $user->delete();
        return redirect('/user');
    }
}
