<?php

namespace App\Repositories;

use App\Model\User;
use App\Models\Post;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    protected $model;
    use UploadAble;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function all()
    {

        return $this->model::
        whereStatus('PUBLISHED')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function all_api()
    {

        $d = $this->model::
        whereStatus('PUBLISHED')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)->toArray();
        return Arr::except(
            $this->model::orderBy('created_at', 'DESC')
                ->paginate(5)->toArray()
            , ['first_page_url', 'last_page_url', 'next_page_url', 'links', 'path', 'prev_page_url']);
    }

    public function create(array $data)
    {




        return $this->model->create(Arr::collapse([

            $data, ['user_id' => auth()->id(),
                'slug' => Str::slug($data['title']),
                'lang' => 'en',
            ]]));


    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $post = $this->model->find($id)) {
            throw new ModelNotFoundException("User not found");
        }

        return $post;
    }


    public function findBySlug(string $slug)
    {
        if (true) {
            return $this->_showBySlug_cache($slug);
        }
        return $this->_showBySlug_db($slug);

    }


    function _showBySlug_db(string $slug)
    {
        sleep(11);
        return Post::whereSlug($slug)->firstOrFail();


    }


    function _showBySlug_cache(string $slug)
    {

        return cache()->remember("posts.{$slug}", 3600, function () use ($slug) {

            return $this->_showBySlug_db($slug);
        });

    }

}
