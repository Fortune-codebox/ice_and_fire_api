<?php

namespace App\Requests; 

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'isbn' => 'required|string',
            'authors' => 'required|string',
            'number_of_pages' => 'required|integer',
            'publisher' => 'required|string',
            'country' => 'required|string',
            'release_date' => 'required|date'
           
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name' => 'name is required',
            'isbn' => 'isbn is required',
            'authors' => 'authors is required',
            'number_of_pages' => 'number of pages is required',
            'publisher' => 'publisher is required',
            'country' => 'country is required',
            'release_date' => 'released date is required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], 422));
        // JsonResponse::HTTP_UNPROCESSABLE_ENTITY
    }
}