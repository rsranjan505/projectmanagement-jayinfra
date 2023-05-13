<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_category_id','name','code','brand_id','model_no','serial_number','size','color','tax_rate_id','hsn_code','mrp','sell_price','description','created_by','is_active'];
	protected $dates = ['created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function tax_rate(){
        return $this->belongsTo(TaxRate::class,'tax_rate_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function image()
    {
        return $this->morphOne(AssetFile::class, 'pictureable','model_type', 'model_id');
    }
}
