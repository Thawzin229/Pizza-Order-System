<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function ajaxData(Request $data){
        if($data->status == "asc"){
            $data  = Product::orderby('created_at',"asc")->get();
        }else{
            $data  = Product::orderby('created_at',"desc")->get();
        }
        return $data;
    }
    //order
    public function order(Request $data){
        $finalData = $this->indirectData($data);
        Cart::create($finalData);
        return [
            "status" => "success"
        ];
    }

    //indirectData
    public function indirectData($data){
        $indirectData = [
            "user_id" => $data->userId,
            "product_id" => $data->pizzaId,
            "quantity" => $data->ordercount
        ];
        return $indirectData;
    }

    //orderlist 
    public function orderList(Request $data){
        $totalPrice = 0;
        foreach($data->all() as $item){
           $orderData  = OrderList::create([
                "user_id" => $item["user_id"],
                "product_id" => $item["product_id"],
                "quantity" => $item["quantity"],
                "total" => $item["total"],
                "ordercode" => $item["ordercode"],
            ]);
            $totalPrice += $item["total"];
        }

        Cart::where("user_id", Auth::user()->id)->delete();
        Order::create([
            "user_id"  => $orderData->user_id,
            "ordercode"  => $orderData->ordercode,
            "totalprice" => $totalPrice + 10,
        ]);

        return ["status" => "success"];
    }

    //order cancel
    public function clearOrder(Request $data){
        if($data->status == "deleteall"){
            Cart::where("user_id" , Auth::user()->id)->delete();
        }

        return ["status" => "ordercancelsuccess"];
    }

    //single cart deletion
    public function deleteSingleCart(Request $data){
        logger($data->all());
        Cart::where("user_id",Auth::user()->id)
            ->where("id",$data->cart_id)
            ->delete();

            return ["status" => "singlecartdeleted"];
    }

    //view count 
    public function addViewCount(Request $data){
        $datas = Product::where("id",$data->product_id)->first();
        $viewCount = $datas["view_count"] + 1 ;
        Product::where("id",$data->product_id)->update(["view_count" => $viewCount]);
        return redirect()->route("user#home");

    }
}
