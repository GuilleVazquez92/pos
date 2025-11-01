<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property string $barcode
 * @property float|null $regular_price
 * @property float $price
 * @property int $quantity
 * @property float $tax
 * @property bool $is_custom_product
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Cart[] $carts
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'regular_price' => 'float',
		'price' => 'float',
		'quantity' => 'int',
		'tax' => 'float',
		'is_custom_product' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'image',
		'barcode',
		'regular_price',
		'price',
		'quantity',
		'tax',
		'is_custom_product',
		'status',
		'type',
		'category'
	
	];

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
