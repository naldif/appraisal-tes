<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo',
        'role',
        'contact_number',
    ];

    /**
     * Get the user that owns the DetailUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
