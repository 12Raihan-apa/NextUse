++ app/Models/Item.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'status',
        'image_path',
        'description',
        'listed_at',
    ];

    protected $casts = [
        'listed_at' => 'datetime',
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_OUT_OF_STOCK = 'out_of_stock';
    public const STATUS_RESERVED = 'reserved';

    public const STATUS_LABELS = [
        self::STATUS_AVAILABLE => 'Tersedia',
        self::STATUS_OUT_OF_STOCK => 'Habis',
        self::STATUS_RESERVED => 'Reserved',
    ];
}

