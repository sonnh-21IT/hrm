<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;
    
    protected $table = 'persons';

    protected $fillable = [
        'full_name', 
        'user_id',
        'gender', 
        'birthdate', 
        'phone_number', 
        'company_id',
        'address'
    ];

    /**
     * Get the custom user that owns the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customuser(): BelongsTo
    {
        return $this->belongsTo(CustomUser::class, 'user_id', 'id');
    }

    /**
     * Get the company that owns the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * The project that belong to the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'person_project', 'project_id', 'person_id');
    }

    /**
     * Get all of the task for the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'person_id', 'id');
    }
}
