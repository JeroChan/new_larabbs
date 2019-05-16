<?php

namespace App\Http\Requests\Api;

class ReplyRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'content' => 'required|min:2',
                ];
                break;
        }

    }
}
