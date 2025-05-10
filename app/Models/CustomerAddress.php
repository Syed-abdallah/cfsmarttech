<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'full_name',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip',
        'country',
        'is_default',
    ];
    

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function booted()
    {
        static::creating(function ($address) {
            // If this is being set as default, remove default status from others
            if ($address->is_default) {
                self::where('customer_id', $address->customer_id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });

        static::updating(function ($address) {
            // If this is being set as default, remove default status from others
            if ($address->is_default) {
                self::where('customer_id', $address->customer_id)
                    ->where('id', '!=', $address->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });
    }
}