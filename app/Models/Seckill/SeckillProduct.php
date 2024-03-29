<?php

namespace App\Models\Seckill;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SeckillProduct extends Model
{
    protected $fillable=['name','stock','price','start_date','end_date','contact_phone','contact_name'];

    /** 当前时间早于秒杀时间，返回true
     * @return bool
     */
    public function getIsBeforeStartDateAttribute(){

        return now()->lt($this->start_date);
    }

    /** 当前时间晚于秒杀时间，返回true
     * @return bool
     */

    public function getIsAfterEndDateAttribute(){
        return now()->gt($this->end_date);
    }
}
