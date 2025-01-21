<?php

namespace App\Models\user;

use App\Models\Allergy;
use App\Models\Estate;
use App\Models\Preference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

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
        'balance'
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
            ->withTimestamps()
            ->withPivot('addressPhone', 'addressIdentifier')
            ->orderBy('updated_at', 'desc');
    }

    public function allergies(){
        return $this->belongsToMany(Allergy::class, 'users_allergies');
    }

    public function preferences(){
        return $this->belongsToMany(Preference::class, 'users_preferences');
    }

    public function fav_estates(){
        return $this->belongsToMany(Estate::class, 'users_fav_estates');
    }
}
