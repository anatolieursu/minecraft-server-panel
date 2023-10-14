<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffApiRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function create(StaffApiRequest $request) {
        if($request->password == env("PASSWORD_STAFF")) {
            Staff::create([
                "name" => $request->name,
                "rank" => $request->rank,
            ]);

            return response()->json([
                "status" => "Succesfuly added"
            ]);
        } else {
            return response()->json([
                "status" => "Invalid password"
            ]);
        }
    }
}
