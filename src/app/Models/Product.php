<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const CATEGORY_LABORATORY = 'laboratory';
    const CATEGORY_GELATO = 'gelato';
    const CATEGORY_PACKAGING = 'packaging';
    const CATEGORY_CHOCOLATE = 'chocolate';

    const AVAILABLE = 1;
    const UNAVAILABLE = 0;

    const UOM_KG = 'kg';
    const UOM_G = 'g';

    const FAMILY_GIFTING = 'gifting';
    const FAMILY_CHOCOLATE_DIPOSABLE = 'chocolate diposable';
    const FAMILY_F_AND_B_DIPOSABLE = 'f&b diposable';
    const FAMILY_GELATO_LAB_AND_TOOLS = 'gelato lab & tools';
    const FAMILY_VISUAL_MERCHANDISING_AND_FURNITURE = 'visual merchandising & furniture';
    const FAMILY_UNIFORM = 'uniform';
    const FAMILY_COMMUNICATION = 'communication';

    const PACK_BAG = 'bag';
    const PACK_BOTTLE = 'bottle';
    const PACK_BULK = 'bulk';
    const PACK_CALENDAR = 'calendar';
    const PACK_GIFT_BAG = 'gift bag';
    const PACK_GIFT_BOX = 'gift box';
    const PACK_JAR = 'jar';
    const PACK_MINI_BAG = 'mini bag';
    const PACK_MINI_BLOCK = 'mini block';
    const PACK_METAL_BOX = 'metal box';
    const PACK_PACKAGING = 'packaging';
    const PACK_TIN = 'tin';
    const PACK_TUB = 'tub';
    const PACK_UNWRAPPED = 'unwrapped';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_id',
        'code',
        'category',
        'family',
        'description_en',
        'description_es',
        'description_it',
        'unit_weight',
        'unit_total',
        'pieces',
        'uom',
        'pack_description',
        'photo',
        'stock',
        'availability',
        'availability_date',
        'unit_price',
        'total_price'
    ];

    // Categories
    public static function getCategoriesArr()
    {
        return [
            self::CATEGORY_LABORATORY => __('Laboratory'),
            self::CATEGORY_GELATO => __('Gelato'),
            self::CATEGORY_PACKAGING => __('Packaging'),
            self::CATEGORY_CHOCOLATE => __('Chocolate'),
        ];
    }

    // Family
    public static function getFamilyArr()
    {
        return [
            self::FAMILY_GIFTING => __('Gifting'),
            self::FAMILY_CHOCOLATE_DIPOSABLE => __('Chocolate Diposable'),
            self::FAMILY_F_AND_B_DIPOSABLE => __('F&B Diposable'),
            self::FAMILY_GELATO_LAB_AND_TOOLS => __('Gelato Lab & Tools'),
            self::FAMILY_VISUAL_MERCHANDISING_AND_FURNITURE => __('Visual Merchandising & Furniture'),
            self::FAMILY_UNIFORM => __('Uniform'),
            self::FAMILY_COMMUNICATION => __('Communication'),
        ];
    }

    //Pack Description
    public static function getPackArr()
    {
        return [
            self::PACK_BAG => __('Bag'),
            self::PACK_BOTTLE => __('Bottle'),
            self::PACK_BULK => __('Bulk'),
            self::PACK_CALENDAR => __('Calendar'),
            self::PACK_GIFT_BAG => __('Gift Bag'),
            self::PACK_GIFT_BOX => __('Gift Box'),
            self::PACK_JAR => __('Jar'),
            self::PACK_MINI_BAG => __('Mini Bag'),
            self::PACK_MINI_BLOCK => __('Mini block'),
            self::PACK_METAL_BOX => __('Metal Box'),
            self::PACK_PACKAGING => __('Packaging'),
            self::PACK_TIN => __('Tin'),
            self::PACK_TUB => __('Tub'),
            self::PACK_UNWRAPPED => __('Unwrapped'),
        ];
    }

    // Availability
    public static function getAvailabilityArr()
    {
        return [
            self::AVAILABLE => __('Available'),
            self::UNAVAILABLE => __('Unavailable'),
        ];
    }

    // Units of Measurement
    public static function getUOMArr()
    {
        return [
            self::UOM_KG => __('Kilograms'),
            self::UOM_G => __('Grams'),
        ];
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = strtolower($value);
    }

    public function getCategoryAttribute($value)
    {
        return strtolower($value);
    }

    public function setFamilyAttribute($value)
    {
        $this->attributes['family'] = strtolower($value);
    }

    public function getFamilyAttribute($value)
    {
        return strtolower($value);
    }
    /*
    public function setDescriptionEnAttribute($value)
    {
        $this->attributes['description_en'] = strtolower($value);
    }

    public function getDescriptionEnAttribute($value)
    {
        return ucwords($value);
    }

    public function setDescriptionEsAttribute($value)
    {
        $this->attributes['description_es'] = strtolower($value);
    }

    public function getDescriptionEsAttribute($value)
    {
        return ucwords($value);
    }

    public function setDescriptionItAttribute($value)
    {
        $this->attributes['description_it'] = strtolower($value);
    }

    public function getDescriptionItAttribute($value)
    {
        return ucwords($value);
    }*/

    public function setUomAttribute($value)
    {
        $this->attributes['uom'] = strtolower($value);
    }

    public function getUomAttribute($value)
    {
        return strtolower($value);
    }


    public function scopeFilterWarehouse($query)
    {
        $query = Auth::user()->isWarehouse() ? $query->where('warehouse_id', Auth::id()) : $query;

        return $query;
    }

    /**
     * The warehouse to this product.
     */
    public function warehouse()
    {
        return $this->belongsTo(User::class, 'warehouse_id');
    }

}
