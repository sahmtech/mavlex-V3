<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DarkModeController extends Controller
{
    public function toggle(Request $request)
    {
        session(['dark_mode' => $request->dark_mode]);
        return response()->json(['status' => 'success']);
    }
}
