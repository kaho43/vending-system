<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // テーブル名がデフォルトと異なる場合に指定
    protected $table = 'companies'; // 明示的にテーブル名を指定（必要であれば）

    // 追加・更新を許可するフィールド
    protected $fillable = ['company_name', 'street_address', 'representative_name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id');
    }


}


