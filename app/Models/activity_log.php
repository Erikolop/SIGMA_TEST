<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_log extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityLogFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $table = 'activity_logs';

    protected $fillable = [
        'nama_user',
        'nama_item',
        'tgl_transaksi',
        'jenis_mutasi',
        'sebelum_qty',
        'perubahan_qty',
    ];

    protected $casts = [
        'tgl_transaksi' => 'datetime',
    ];
    /* ── Relationships ── */

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
}
