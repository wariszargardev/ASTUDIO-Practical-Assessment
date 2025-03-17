<?php

namespace App\Services;

use App\Models\Attribute;

class AttributeValueService
{
    public function createOrUpdate($project, $attributes)
    {
        foreach ($attributes as $attributeName => $value) {
            $attribute = Attribute::where('name', $attributeName)->first();
            if ($attribute) {
                $project->attributes()->updateOrCreate(
                    ['attribute_id' => $attribute->id],
                    ['value' => $value]
                );
            }
        }
    }
}
