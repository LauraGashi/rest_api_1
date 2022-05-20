<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function Index()
    {
        return Post::all();
    }
    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post -> save())
            {
                return response()->json(['status' => 'success', 'message' => 'Post created successfully@']);
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->body = $request->body;
            $user_id = $post->user_id;
            $user_detail = User_Detail::where('user_id', '=' , $user_id);
            $user_type = $user_detail->user_type;
            if($user_type == 1){
                if ($post -> save())
                {
                    return response()->json(['status' => 'success', 'message' => 'Post updated successfully']);
                }
            }
            else{
                $user = User :: findOrFail($request->user_id);
                $userId = $user -> id;
                if($user_id == $userId){
                    if ($post -> save())
                    {
                        return response()->json(['status' => 'success', 'message' => 'Post updated successfully']);
                    }                }
                else{
                    return response()->json(['status' => 'error', 'message' => 'Post can\'t be updated']);
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
            $post = Post::findOrFail($id);
            $user_id = $post->user_id;
            $user_detail = User_Detail::where('user_id', '=' , $user_id);
            $user_type = $user_detail->user_type;
            if($user_type == 1){
                if ($post -> delete())
                {
                    return response()->json(['status' => 'success', 'message' => 'Post deleted successfully']);
                }
            }
            else{
                $user = User :: findOrFail($request->user_id);
                $userId = $user -> id;
                if($user_id == $userId){
                    if ($post -> delete())
                    {
                        return response()->json(['status' => 'success', 'message' => 'Post deleted successfully']);
                    }                }
                else{
                    return response()->json(['status' => 'error', 'message' => 'Post can\'t be deleted']);
                }
            }
        } catch(\Exception $e)
        {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
