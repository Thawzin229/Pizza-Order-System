<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //ordr ,\list
    public function orderList(){
        $searchVal = request("searchVal");
        $orderList =  Order::select("orders.*","users.name as username")
                    ->join("users","orders.user_id","users.id")
                    ->when($searchVal,function($table,$searchVal){
                        $table->where("users.name","like","%{$searchVal}%");
                    })
                    ->orderBy("created_at","desc")
                    ->paginate();
        return view("admin.order.list",compact("orderList"));
    }

    //order sorting
    public function orderSorting(Request $data){
        if($data->orderstatus == "all"){
          $orderList =Order::select("orders.*","users.name as username")
            ->join("users","orders.user_id","users.id")
            ->paginate();
        }else{
            $orderList = Order::select("orders.*","users.name as username")
            ->join("users","orders.user_id","users.id")
            ->where("orders.status",$data->orderstatus)
            ->paginate();
        }
        return view("admin.order.list",compact("orderList"));
    }

    //change status
    public function changeStatus(Request $data){
        Order::where("id",$data->orderid)->update(["status" => $data->status]);
        return ["status" => "success"];
    }

    //product list 
    public function productList($ordercode){
        $ordercodeforTotalPrice = Order::where("ordercode",$ordercode)->first()->toArray();
        $productList = OrderList::select("order_lists.*","users.name as user_name","users.phone as user_phone","products.name as product_name","products.image as product_image")
        ->join("users","order_lists.user_id","users.id")
        ->join("products","order_lists.product_id","products.id")
        ->where("order_lists.ordercode",$ordercode)
        ->paginate();
        return view("admin.order.productlist",compact("productList","ordercodeforTotalPrice"));
    }
}
