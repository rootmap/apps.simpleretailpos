<?php

namespace App\Http\Requests;

use \Exception;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
     * @param $model
     * @return array
     * @throws Exception
     */
    protected function initRules($model)
    {
        if (!is_object($model)) {
            throw new Exception('This is not an object');
        }

        switch (strtolower($this->method())) {
            case 'post':
                return $model->createdRules();
            case 'patch':
            case 'put':
                return $model->updatedRules();
            default:
                return [];
        }
    }
}
