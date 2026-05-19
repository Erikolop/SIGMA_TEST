<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id_kategori', 'item_name', 'item_qty'];

    /* ── Relationships ── */

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function activityLogs()
    {
        return $this->hasMany(activity_log::class, 'id_item');
    }
}
