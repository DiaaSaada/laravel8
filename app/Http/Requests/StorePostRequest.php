<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:255|min:10',
            'summary' => 'required|unique:posts|max:255|min:10',
            'body' => ['required' , 'max:2048'],
            'is_featured' => [  'accepted' , 'nullable'],
            'featured_image' => ['file' , 'nullable'],
        ];
    }
}
