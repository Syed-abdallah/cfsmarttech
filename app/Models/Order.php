<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'subtotal', 'tax', 'shipping', 'total',
        'payment_method', 'payment_slip', 'status', 'shipping_address'
    ];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
      public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
}