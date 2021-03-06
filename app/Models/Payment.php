<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Payment
 * @package App\Models
 *
 * @param integer $user_id
 * @param integer $stripe_id
 * @param integer $subtotal
 * @param integer $tax
 * @param integer $total
 *
 * @mixin Builder
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_id',
        'subtotal',
        'tax',
        'total'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $nr
     *
     * @return string
     */
    public function getTotalAttribute($nr): string
    {
        return number_format($nr / 100, 2);
    }
}
