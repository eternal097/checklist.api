<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        switch ($this->getMethod())
        {
            case 'POST':
                return [
                    'message' => 'required|string|max:255',
                ];
            case 'PUT':
                return [
                    'id' => 'integer|exists:task,id',
                    'completed' => 'boolean',
                ];
            case 'DELETE':
                return [
                    'id' => 'integer|exists:task,id'
                ];
        }
    }
}
