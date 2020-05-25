<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateConfirmRequest extends FormRequest
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
        $id = $this->id ? ',' . $this->id : '';

        return
         [
            'name' => 'required|max:255|unique:users,name'.$id,
            'email' => 'required|max:255|unique:users,email'.$id,
            'type' => 'required',
        ];
    }
}
