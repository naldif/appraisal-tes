<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'module_id',
        'menu_name',
        'icon',
        'route',
        'sequence',
        'created_by',
        'updated_by',
    ];

    /**
     * Get all of the submenu for the MenuItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submenu(): HasMany
    {
        return $this->hasMany(SubMenu::class, 'menu_id');
    }

    /**
     * Get the module that owns the MenuItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
