<?php

namespace App\Http\Controllers;

use App\Models\Copoun;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $col = collect(["A", "B", "C"]);
        return Copoun::all();


    }

    public function create()
    {


        return view('posts.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {


        $data = Arr::collapse( [ $request->validate(
                [
                    'title' => 'required|unique:posts|max:255|min:10',
                    'body' => ['required'],
                ]), ['user_id' => auth()->id()] ] )  ;
        /** @var  $post  Post */
        $post = Post::create( $data);

        dd($post->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Copoun $copoun
     * @return Response
     */
    public function show(Copoun $copoun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Copoun $copoun
     * @return Response
     */
    public function update(Request $request, Copoun $copoun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Copoun $copoun
     * @return Response
     */
    public function destroy(Copoun $copoun)
    {
        //
    }
}
