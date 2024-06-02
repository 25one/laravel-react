<?php

namespace App\Http\Requests;

class CommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'comment' => 'required',             
        ];
    }

    public function messages()
    {
          return [
            'comment.required' => 'Field New Comment must be filled in!',
          ];
    }     
}
