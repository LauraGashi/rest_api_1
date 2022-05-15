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

            if ($reply -> save())
            {
                return response()->json(['status' => 'success', 'message' => 'Reply updated successfully@']);
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

            if ($reply -> delete())
            {
                return response()->json(['status' => 'success', 'message' => 'Reply deleted successfully@']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
