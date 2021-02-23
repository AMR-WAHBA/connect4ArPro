<?php

namespace App\Http\Requests;

class AtempetLoginRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'remmber_me' => $this->get('remmber_me')? 1 : 0 ,
        ]);
    }
    public function rules()
    {
        return [
            'name' => ['required'],
            'password' => ['required'],
            'remmber_me' => ['nullable'],
        ];
    }
}
