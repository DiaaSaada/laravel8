<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Post;
use PHPUnit\Framework\TestCase;
use Tests\ApiTestTrait;

class UserTest extends TestCase
{



    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $posts = factory(Post::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/users', $posts
        );

        $this->assertApiResponse($posts);
    }
}
