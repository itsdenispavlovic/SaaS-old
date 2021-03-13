<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 * @version March 13, 2021, 10:13 am UTC
 *
 * @property int $contact_type_id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property bool $have_read
 *
 * @mixin Builder
 */
class Contact extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contacts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'contact_type_id',
        'name',
        'email',
        'content',
        'have_read'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contact_type_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contact_type_id' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'content' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
