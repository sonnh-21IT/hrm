<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomUser extends Model
{
    use HasFactory;

    protected $table = 'custom_users';

    protected $fillable = [
        'email', 
        'password', 
        'is_active'
    ];

    /**
     * Get the person associated with the CustomUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function person(): HasOne
    {
        return $this->hasOne(Person::class, 'user_id', 'id');
    }

    /**
     * The user that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_custom_user', 'custom_user_id', 'role_id');
    }
}
