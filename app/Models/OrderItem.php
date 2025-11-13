<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property float $price
 * @property int $quantity
 * @property string|null $description
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property float $tax
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property Product $product
 * @property OrderAddon $order_addon
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'order_items';

	protected $casts = [
		'price' => 'float',
		'quantity' => 'int',
		'order_id' => 'int',
		'product_id' => 'int',
		'tax' => 'float'
	];

	protected $fillable = [
		'price',
		'quantity',
		'description',
		'order_id',
		'product_id',
		'name',
		'tax'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	 public function addons()
    {
        return $this->hasMany(OrderAddon::class);
    }
}
