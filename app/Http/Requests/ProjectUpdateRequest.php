<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255|unique:projects,name,' . $this->route('project'),
            'status' => 'required|in:' . implode(',', ProjectStatus::values()),
        ];
        $attributes = request()['attributes'];
        if ($this->has('attributes') && is_array($attributes)) {
            foreach ($attributes as $attributeInfo) {
                $attribute = Attribute::where('name', $attributeInfo['name'])->first();

                if ($attribute) {
                    $rules["attributes.*.value"] = $this->getAttributeValidationRule($attribute);
                }
            }
        }

        return $rules;
    }

    private function getAttributeValidationRule(Attribute $attribute): string
    {
        return match ($attribute->type) {
            'text' => 'required|string|max:255',
            'date' => 'required|date',
            'number' => 'required|numeric',
            'select' => 'required|string|in:option1,option2,option3',
        };
    }
}
