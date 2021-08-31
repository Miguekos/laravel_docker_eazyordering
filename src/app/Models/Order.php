<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_id',
        'manager_id',
        'date',
        'total'
    ];


    /**
     * The warehouse to this order.
     */
    public function warehouse()
    {
        return $this->belongsTo(User::class, 'warehouse_id');
    }

    /**
     * The manager to this order.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * The products of this order
     */    
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'unit_price');
    }
}
