<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name','company_id', 'price','stock','comment','image_path' ,];
    public function company()
    {
        return $this->belongsTo(Company::class , 'company_id' );
    }
}

