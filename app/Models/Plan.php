<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Plan
 * @package App\Models
 *
 * @param string $name
 * @param integer $price
 * @param integer $stripe_plan_id
 *
 * @mixin Builder
 */
class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stripe_plan_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->withPivot(['max_amount']);
    }

    /**
     * @param $nr
     *
     * @return string
     */
    public function getPriceAttribute($nr): string
    {
        return number_format($nr / 100, 2);
    }
}
