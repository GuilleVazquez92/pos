<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddon extends Model
{
    use HasFactory;
    protected $table = 'order_item_addons';


    protected $fillable = [
        'order_item_id',
        'name',
        'price',
        'type', // puede ser 'extra' o 'remove'
    ];

    // 🔗 Relación: cada addon pertenece a un item
    public function order_item()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
