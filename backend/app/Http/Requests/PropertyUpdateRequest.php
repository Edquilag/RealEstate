<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isBroker() ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'property_type' => ['required', 'string'],
            'listing_type' => ['required', 'string', 'in:sale,lease'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'floor_area' => ['required', 'numeric', 'min:0'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
