<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $name
 * @property int $quantity
 * @property float $price
 * @property float $tax
 * @property string|null $added
 * @property string|null $removed
 * @property string|null $notes
 * 
 * @property Product $product
 * @property User $user
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'cart';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'tax' => 'float'
	];

	protected $fillable = [
		'user_id',
		'product_id',
		'name',
		'quantity',
		'price',
		'tax',
		'added',
		'removed',
		'notes'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
