<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'module_name',
        'sequence',
        'created_by',
        'updated_by',
    ];

    /**
     * Get all of the menu_item for the Module
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuitem(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'module_id');
    }
}
