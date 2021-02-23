<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FormRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return trans('custom-attributes');
    }

    public function checkAdminIsManagerOnly()
    {
        return $this->adminType == 'manager' ? true : abort(404);
    }
    /**
     * failedValidationCustom
     * @param array $data to merge with errors
     * @return void
     */
    protected function failedValidationCustom(array $data)
    {
        $errors = (new ValidationException($this->validator))->errors();
        throw new HttpResponseException(
            response()->json(array_merge($data, ['errors' => $errors]), JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

}
