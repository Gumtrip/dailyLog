<?php

namespace App\Models\Seckill;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
class SeckillOrder extends Model
{
    protected $fillable=['no','total_amount'];


    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = 'S' . date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning(sprintf('find order no failed'));

        return false;
    }

    public function items(){
        return $this->hasMany(SeckillOrderItems::Class);
    }

    public function user(){
        return $this->belongsTo(User::Class);
    }

}
