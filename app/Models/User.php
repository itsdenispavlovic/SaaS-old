<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

/**
 * Class User
 * @package App\Models
 * @version March 6, 2021, 9:38 am UTC
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $two_factor_secret
 * @property string $two_factor_recovery_codes
 * @property string $type
 * @property string $remember_token
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Billable;

    use HasFactory;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at', 'trial_ends_at'];

    const USER_TYPES = [
        'user' => 'User',
        'admin' => 'Admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'type',
        'remember_token',
        'trial_ends_at',
        'company_name',
        'address_line_1',
        'address_line_2',
        'country_id',
        'city',
        'postcode',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'username' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'two_factor_secret' => 'string',
        'two_factor_recovery_codes' => 'string',
        'type' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'nullable|max:255',
        'two_factor_secret' => 'nullable|string',
        'two_factor_recovery_codes' => 'nullable|string',
        'type' => 'required|string',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Here add the features like this
//    public function tasks()
//    {
//        return $this->hasMany(Task::class);
//    }
    // In tasks/index.php use @can('tasks_create) => they can create @else You have reached the limit of your plan. Please /route billing/ Upgrade your plan

}
