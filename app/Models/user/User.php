<?php

namespace App\Models\user;

use App\Models\Address;
use App\Models\Billing;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'nif',
        'password',
        'birthdate',
        'nationality',
        'language',
        'standard_group',
        'children',
        'phone',
        'img',
        'balance',
        'fav_estate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function user_roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }

    public function language(){
        return DB::table('languages')->where('id', $this->language)->first();
    }

    public function addresses(){
        return $this->belongsToMany(Address::class, 'users_addresses')
            ->withPivot('addressPhone', 'addressIdentifier', 'isFavorite', 'order');
    }

    public function allergies(){
        return $this->belongsToMany(Allergy::class, 'users_allergies');
    }

    public function preferences(){
        return $this->belongsToMany(Preference::class, 'users_preferences');
    }

    public function fav_estate(){
        return DB::table('estates')->where('id', $this->fav_estate)->first()->name ?? null;
    }

    public function getImgAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function billing()
    {
        return $this->hasOne(Billing::class);
    }

    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)
            ->whereHas('products');
    }
}
