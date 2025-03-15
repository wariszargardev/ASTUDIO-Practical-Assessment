<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name', 'type'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
