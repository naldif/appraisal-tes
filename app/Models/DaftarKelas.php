<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'murid_id',
        'mapel_id',
        'eskul_id',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function murid(): BelongsTo
    {
        return $this->belongsTo(Murid::class, 'murid_id', 'id');
    }
    
    public function mapel(): BelongsTo    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }

    public function eskul(): BelongsTo
    {
        return $this->belongsTo(Eskul::class, 'eskul_id', 'id');
    }
}
