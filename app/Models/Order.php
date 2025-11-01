<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int|null $pay_type
 * @property int|null $order_type
 * @property int|null $call_number
 * @property string|null $description
 * @property int|null $customer_id
 * @property float $total_price
 * @property float|null $discount_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer|null $customer
 * @property Collection|OrderItem[] $order_items
 * @property Collection|Payment[] $payments
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'pay_type' => 'int',
		'order_type' => 'int',
		'call_number' => 'int',
		'customer_id' => 'int',
		'total_price' => 'float',
		'discount_price' => 'float'
	];

	protected $fillable = [
		'pay_type',
		'order_type',
		'call_number',
		'description',
		'customer_id',
		'total_price',
		'discount_price'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
