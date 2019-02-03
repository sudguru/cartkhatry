<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Userdetail;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {
        $userdetail = Userdetail::firstOrCreate(
            ['id' => auth()->user()->id],
            [
                'is_admin' => 0,
                'is_super' => 0
            ]
        );
        //check if record exist for the day 
        return view('account.dashboard', [
            'currentPage' => 'dashboard',
            'userdetail' => $userdetail
        ]);
    }

    public function change() {
        \Auth::logout();
        return redirect('/password/reset');
    }

    
}
