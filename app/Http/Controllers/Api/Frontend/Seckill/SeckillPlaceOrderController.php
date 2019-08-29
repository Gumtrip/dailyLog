<?php

namespace App\Http\Controllers\Api\Frontend\Seckill;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Seckill\SeckillOrder;
use App\Models\Seckill\SeckillProduct;
use App\Transformers\Frontend\Seckill\SeckillOrderTransformer;
use App\Http\Requests\Frontend\Seckill\SeckillPlaceOrderRequest;
class SeckillPlaceOrderController extends Controller
{
    public function placeOrderHandle(SeckillPlaceOrderRequest $request){
        $amount = 1;
        $seckillProductId=$request->seckillProductId;
        $contactPhone=$request->contactPhone;
        $contactName=$request->contactName;
        $contactData=[
            'contactPhone'=>$contactPhone,
            'contactName'=>$contactName,
        ];
        $order = DB::transaction(function() use($amount,$seckillProductId,$contactData){
            $seckillProduct = SeckillProduct::find($seckillProductId);
            $user = auth('api')->user();
            $orderNo = SeckillOrder::findAvailableNo();

            $totalAmount =$seckillProduct->price * $amount;
            $orderData = [
                'no'=>$orderNo,
                'total_amount'=>$totalAmount,
                'contact_phone'=>$contactData['contactPhone'],
                'contact_name'=>$contactData['contactName'],
            ];

            $order = new SeckillOrder($orderData);
            if($user)$order->user()->associate($user);
            $order->save();


            $item = $order->items()->make([
                'amount' => $amount,
                'price'  => $seckillProduct->price,
            ]);
            $item->seckillProduct()->associate($seckillProduct->id);

            $item->save();
            //减库存
            $item->decrement('stock',$amount);
            \Cache::decrement('seckillProduct-'.$seckillProduct);
//订单项与sku 关联

            return $order;
        });
        return $this->response->item($order,new SeckillOrderTransformer)->setStatusCode(201);
    }



}
