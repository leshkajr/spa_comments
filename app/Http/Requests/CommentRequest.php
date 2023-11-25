<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'captcha' => 'required|captcha',
            'username' => 'required|alpha_num:ascii',
            'email' => 'required|email',
            'comment' => 'required|html',
            'urlHomePage' => 'url',
        ];
    }

    public function messages()
    {
        return ['captcha' => 'Invalid captcha',
            'html' => "Your code doesn't follow the tags rules. Please use only this tags: <b>a[href|title],code,i,strong</b>. And don`t remember <b>close tags</b>"];
    }
}
