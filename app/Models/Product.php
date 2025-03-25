<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // テーブル名がデフォルトと異なる場合に指定
    protected $table = 'products';  // 明示的にテーブル名を指定（必要であれば）

    // 追加・更新を許可するフィールド
    protected $fillable = ['product_name','company_id', 'price','stock','comment','image_path' ,];
    // リレーションシップを定義
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}

