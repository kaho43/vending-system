<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // 売上データのテーブル名
    protected $table = 'sales';

    // ホワイトリスト（Mass Assignment）で扱うカラム
    protected $fillable = [
        'product_id',
    ];

    // タイムスタンプを使用する
    public $timestamps = true;

    // 必要な場合は、関連するProductモデルとのリレーションを定義することもできます
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
