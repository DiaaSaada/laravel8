<?php

namespace App\Http\Controllers\API;


use App\Branch;
use App\City;
use App\Coupon;
use App\Customer;
use App\CustomerAddress;
use App\Gift;
use App\Http\Requests\CreateOrderApiRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\VerifyAccountRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\Post;
use App\Order;
use App\Product;
use App\Promotion;
use App\Region;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Rules\ValidateCoupon;
use App\Rules\ValidateFacebookAccountId;
use App\Rules\ValidateFacebookToken;
use App\VerificationCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class ApiController extends Controller
{

    /**
     * @var PostRepository
     */
    private $postRepository;


    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function test_repository()
    {

        Post::factory()->count(20)->create();

        return $this->postRepository->all()  ;
        return response()->json( $this->postRepository->all() );

    }

       public function test_api()
    {

        SendWelcomeEmail::dispatch()->delay(5);
        $post1 = new Post();
        $post1->title = "efef ef ef ";
        $col = collect(
            [
                $post1, $post1, $post1
            ]
        );
        $res = $col->each(function ($i) {
            $i->title = ucwords($i->title);
        });
        $qs = $_GET['qs'] ?? 'no_qs';  // php 7.4 null check and return
        $user['name'] = [];
        $user['name']['first'] ??= 'no first name';  // php7.4 check isset and return defualt if none
        $sum1 = $this->add_php73(1, 23, 5, 35, 35, 35, 3, 5, 5, 57, 57, 57, 5); // variable number of args
        $sum2 = $this->add_php74(1, 23, 5, 35, 35, 35, 3, 5, 5, 57, 57, 57, 5); // variable number of args
        $result = [$sum1, $sum2];
        return response()->json((['collection' => $res, 'QS' => $qs, 'user' => $user, 'tests' => $result]), 200);
    }


    function add_php73()
    {
        return array_sum(func_get_args()); // retrurn all function args
    }

    function add_php74(int ...$args) // with type restriection
    {
        return array_sum($args); // retrurn all function args
    }

}
