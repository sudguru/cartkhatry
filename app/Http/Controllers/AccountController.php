<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userdetail;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $userdetail = Userdetail::firstOrCreate(
            ['id' => auth()->user()->id],
            [
                'is_admin' => 0,
                'is_super' => 0,
                'vendor_level' => 'NotYet'
            ]
        );

        return view('account.info', [
            'currentPage' => 'accountinfo',
            'userdetail' => $userdetail
        ]);
    }
}
