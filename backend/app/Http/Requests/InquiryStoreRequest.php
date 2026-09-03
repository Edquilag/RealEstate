<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isClient() ?? false;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }
}
