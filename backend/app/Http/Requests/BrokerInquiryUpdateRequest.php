<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrokerInquiryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isBroker() ?? false;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,contacted,closed'],
        ];
    }
}
