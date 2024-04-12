<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function dashboard(){
        $page = request()->query('page', 1);
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        $users = DB::select("SELECT * FROM users LIMIT ?, ?", [$offset, $perPage]);
        $totalCount = DB::selectOne("SELECT COUNT(*) AS total FROM users")->total;
        $totalPages = ceil($totalCount / $perPage);

        return view('home', [
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function register(Request $request){
        $data = $request->all();
        try {
            DB::table('users')->insert([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['pwd']),
                'dob' => $data['dob'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);
            Alert::toast('User Successfully registered', 'success');
            return redirect()->route('loginPage');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
        }
    }

    public function login(Request $request){
        $data = $request->all();
        $remember = $request->has('remember') ? true : false;
        $credentials = [
            'email' => $data['email'],
            'password' => $data['pwd']
        ];
        
        if (Auth::attempt($credentials, $remember)) {
            Alert::toast('Logged in','success');
            return redirect()->route('dashboard');
        } else {
            Alert::toast('Invalid Credentials, please try again ','error');
            return back()->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('loginPage');
    }
}
