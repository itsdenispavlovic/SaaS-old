<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Plan
 * @package App\Models
 * @version March 7, 2021, 9:13 am UTC
 *
 * @property Collection $features
 * @property string $name
 * @property integer $price
 * @property string $stripe_plan_id
 * @property string $billing_period
 *
 * @mixin Builder
 */
class Plan extends Model
{
    use HasFactory;

    public $table = 'plans';

    const MONTHLY_PERIOD = 'monthly';
    const YEARLY_PERIOD = 'yearly';

    const BILLING_PERIODS = [
        self::MONTHLY_PERIOD => 'Monthly',
        self::YEARLY_PERIOD => 'Yealy',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'price',
        'stripe_plan_id',
        'billing_period'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'integer',
        'stripe_plan_id' => 'string',
        'billing_period' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|integer',
        'stripe_plan_id' => 'required|string|max:255',
        'billing_period' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
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
