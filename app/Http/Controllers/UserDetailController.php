<?php

namespace App\Http\Controllers;

use App\Models\User_Detail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    public function Index()
    {
        return User_Detail::all();
    }
    public function store(Request $request)
    {
        try {
            $user_detail = new User_Detail();
            $user_detail->user_id = $request->user_id;
            $user_detail->user_type = $request->user_type;
            $user_detail->address = $request->address;

            if ($user_detail -> save())
            {
                return response()->json(['status' => 'success', 'message' => 'User_Detail created successfully@']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user_detail = User_Detail::findOrFail($id);
            $user_detail->user_id = $request->user_id;
            $user_detail->user_type = $request->user_type;
            $user_detail->address = $request->address;

            if ($user_detail -> save())
            {
                return response()->json(['status' => 'success', 'message' => 'User_Detail updated successfully']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user_detail = User_Detail::findOrFail($id);

            if ($user_detail -> delete())
            {
                return response()->json(['status' => 'success', 'message' => 'User_Detail deleted successfully']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
