<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function Index()
    {
        return Reply::all();
    }
    public function store(Request $request)
    {
        try {
            $reply = new Reply();
            $reply->user_id = $request->user_id;
            $reply->post_id = $request->post_id;
            $reply->comment = $request->comment;

            if ($reply -> save())
            {
                return response()->json(['status' => 'success', 'message' => 'Reply created successfully@']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $reply = Reply::findOrFail($id);
            $reply->user_id = $request->user_id;
            $reply->post_id = $request->post_id;
            $reply->comment = $request->comment;

            $user_id = $reply->user_id;
            $user_detail = User_Detail::where('user_id', '=' , $user_id);
            $user_type = $user_detail->user_type;
            if($user_type == 1){
                if ($user -> save())
                {
                    return response()->json(['status' => 'success', 'message' => 'Reply updated successfully']);
                }
            }
            else{
                $user = User :: findOrFail($request->user_id);
                $userId = $user -> id;
                if($user_id == $userId){
                    if ($user -> save())
                    {
                        return response()->json(['status' => 'success', 'message' => 'Reply updated successfully']);
                    }                }
                else{
                    return response()->json(['status' => 'error', 'message' => 'Reply can\'t be updated']);
                }
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $reply = Reply::findOrFail($id);
            $user_id = $reply->user_id;
            $user_detail = User_Detail::where('user_id', '=' , $user_id);
            $user_type = $user_detail->user_type;
            if($user_type == 1){
                if ($user -> delete())
                {
                    return response()->json(['status' => 'success', 'message' => 'Reply deleted successfully']);
                }
            }
            else{
                $user = User :: findOrFail($request->user_id);
                $userId = $user -> id;
                if($user_id == $userId){
                    if ($user -> delete())
                    {
                        return response()->json(['status' => 'success', 'message' => 'Reply deleted successfully']);
                    }}
                else{
                    return response()->json(['status' => 'error', 'message' => 'Reply can\'t be deleted']);
                }
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
