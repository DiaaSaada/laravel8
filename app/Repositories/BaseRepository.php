<?php

namespace App\Repositories;

use App\Model\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

abstract class BaseRepository
{
    protected $model;

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
        return $this->model->create($data);
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
}
