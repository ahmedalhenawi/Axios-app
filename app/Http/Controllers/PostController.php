<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        return response()->json(['message'=>'تمت العملية بنجاح'],Response::HTTP_OK);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator = validator($request->all(), [
            'title'=>'required',
            'content'=>'required'
        ]);


        if(!$validator->fails()){
            if ($request->has('cover')) {
                //delete old image if exist
                if (Storage::disk('public')->exists("post/$post->img")) {
                    Storage::disk('public')->delete("post/$post->img");
                }

                // receive and store new image
                $cover = $request->file('cover');
                $coverName = time() . $request->name . '.' . $cover->getClientOriginalExtension();
                $request->file('cover')->storePubliclyAs('post', $coverName, ['disk' => 'public']);
                $request->cover = $coverName;
            }
            $post->update(['img' => $request->cover]);

            return response()->json(['message'=>'delete تمت العملية بنجاح'],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->get('title')[0]],Response::HTTP_OK);
        }
//        $request->validate([
//            'title'=>'required',
//            'content'=>'required'
//        ]);
        return response()->json(['message'=>'delete تمت العملية بنجاح'],Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
