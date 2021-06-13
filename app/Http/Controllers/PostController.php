<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Copoun;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class PostController extends Controller
{

    use UploadAble;

    /**
     * @var PostRepository
     */
    private $postRepository;


    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


        $posts = $this->postRepository->all();
        return view('posts.index', compact('posts'));


    }

    public function create()
    {


        return view('posts.create');


    }

    /**
     * Store a newly created resource in storage.
     * Using Custom Request CLass for Validation
     * Using Repository
     *
     * @param Request $request
     * @return Response
     */
    public function store(StorePostRequest $request)
    {


        $input = $this->uploadImageIfExist($request, 'featured_image', $request->all(), 'uploads/images/');
        dd($input);


        $post = $this->postRepository->create($request->validated(), auth()->id());

        if (!empty($post->id)) {
            Flash::success('Post saved successfully.');
            return redirect()->route('posts.show', ['slug' => $post->slug]);
        }
        dd($post);
        return view('posts.create');
    }

    public function store_simple(Request $request)
    {


        $data = Arr::collapse([$request->validate(
            [
                'title' => 'required|unique:posts|max:255|min:10',
                'body' => ['required'],
            ]), ['user_id' => auth()->id()]]);
        /** @var  $post  Post */
        $post = Post::create($data);

        dd($post->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Copoun $copoun
     * @return Response
     */
    public function show(Post $post)
    {
        $title = 'awdawddddddd';
        Post::where(['title' => $title]);
        return Post::whereTitle($title)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Response
     */
    public function showBySlug(string $slug)
    {

        $post = $this->postRepository->findBySlug( $slug ) ;
        return view('posts.show', compact('post'));
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
