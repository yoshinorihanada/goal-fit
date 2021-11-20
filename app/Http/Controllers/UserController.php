<?php
namespace App\Http\Controllers;

ini_set("display_errors", 1);
error_reporting(E_ALL);

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showPoint(){
        $user_id = Auth::id();
        $user = User::find($user_id);
        Log::info($user);
        return $user->point;
        // return User::select('points')->get();
    }

    public function updatePoint(Request $request){
        $user = Auth::user();
        $user->point = $request->point;
        $user->save();

        return $user;
    }
}
