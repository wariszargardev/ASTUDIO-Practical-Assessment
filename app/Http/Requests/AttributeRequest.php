<?php

namespace App\Http\Requests;

use App\Enums\AttributeTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:attributes,name,' . $this->route('attribute'),
            'type' => 'required|in:' . implode(',', AttributeTypeEnum::values()),
        ];
    }
}
