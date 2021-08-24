<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => 'required|email',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните имя и Фамилию',
            'email.required' => 'Заполните email',
            'email.email' => 'Email не коректен',
            'phone.required' => 'Введите телефон'
        ];
    }
}

