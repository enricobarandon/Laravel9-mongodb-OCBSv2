<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->is_allowed == 1) {
            return response()->view('backend.cashier.index', [], 404);
        }
        // return $user->user_type->role;
        return response()->view('backend.cashier.waiting', [], 404);
    }
}
