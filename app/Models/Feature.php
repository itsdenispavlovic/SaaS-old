<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 * @package App\Models
 *
 * @param string $name
 *
 * @mixin Builder
 */
class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
