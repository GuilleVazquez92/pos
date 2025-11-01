<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id
 * @property float $amount
 * @property int $order_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property User $user
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payments';

	protected $casts = [
		'amount' => 'float',
		'order_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'amount',
		'order_id',
		'user_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
