@extends("user.layouts.extensionforuser")
@section("content")
 <!-- Cart Start -->
 <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="table" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                            <th>Add</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      @foreach($datas as $item)
                      <tr>
                          <input type="hidden" name="" value="{{ $item['product_price'] }}" id ="price">
                          <input type="hidden" name="" id="user_id"value="{{ $item['user_id'] }}">
                          <input type="hidden" name="" id="cart_id"value="{{ $item['id'] }}">
                          <input type="hidden" name="" id="product_id"value="{{ $item['product_id'] }}">
                            <td class="align-middle">{{ $item['product_name'] }}</td>
                            <td class="align-middle">{{ $item['product_price'] }} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $item['quantity'] }}" id="quantity">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $item["product_price"] * $item['quantity'] }} Kyats</td>
                            <td class="align-middle"><button  class="btn btn-sm btn-danger deleteBtn"><i class="fa fa-times"></i></button></td>
                            <td class="align-middle"><a href="{{ route('user#information',$item['product_id'])}}"><button class="btn btn-sm btn-warning"><i class="zmdi zmdi-shopping-cart"></i></button></a></td>
                        </tr>
                      @endforeach
                    
                    </tbody>
                  </table>
                  <div class="ms-5 mt-4">{{ $datas->links() }}</div>
                </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice }}Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">10 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{ $totalPrice  +10}} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Order<i class="zmdi zmdi-arrow-right ms-3"></i></button>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 " id="cancleBtn">Cancel Order<i class="zmdi zmdi-close-circle-o ms-3 text-light"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section("js")
<script>
    $(".btn-plus").click(function(){
        $parent = $(this).parents("tr");
        $price = $parent.find("#price").val();
        $quantity = Number($parent.find("#quantity").val());
        $total =$price * $quantity;
        $parent.find("#total").html($total + " Kyats");
        totalPrice();

    });
    $(".btn-minus").click(function(){
        $parent = $(this).parents("tr");
        $price = $parent.find("#price").val();
        $quantity = Number($parent.find("#quantity").val());
        $total =$price * $quantity;
        $parent.find("#total").html($total + " Kyats");
        totalPrice();
   
    });

    $(".deleteBtn").click(function(){
        $parent  = $(this).parents("tr");
        $cart_id = $parent.find("#cart_id").val();
        $parent.remove();
        totalPrice();


        $.ajax({
            type:'get',
            data:{"cart_id" :  $cart_id},
            url:"http://127.0.0.1:8000/user/singlecartdelete",
            datatype:"json",
            success:function(data){
                console.log(data.status);
            }
        })
    })

    function totalPrice(){
        $totalPrice = 0;
        $("#table tbody tr").each(function(index,row){
            $totalPrice += Number($(row).find("#total").text().replace("Kyats",""));
        });
        $("#subTotal").html(`${$totalPrice} Kyats`);
        $("#finalTotal").html(`${$totalPrice + 10} Kyats`);
    }

    //order section
    $("#orderBtn").click(function(){
        $orderList =[];
        $randomNumber = Math.floor(Math.random()*1000);
        $("#table tbody tr").each(function(index,row){
            $orderList.push({
                "user_id" : $(row).find("#user_id").val(),
                "product_id" : $(row).find("#product_id").val(),
                "quantity" : $(row).find("#quantity").val(),
                "total" :Number( $(row).find("#total").text().replace("Kyats","")),
                "ordercode" : "order" + $randomNumber,
            });
        })

        $.ajax({
            type:"get",
            data:Object.assign({},$orderList),
            url:"http://127.0.0.1:8000/user/orderlist",
            datatype:"json",
            success:function(data){
                if(data.status == "success"){
                    window.location.href="http://127.0.0.1:8000/user/orderhistory";
                }
            }
        })
    })
    //cancel section
    $("#cancleBtn").click(function(){
        $("#table tbody tr").remove();
        $("#subTotal").html(`0 Kyats`);
        $("#finalTotal").html(`10 Kyats`);

        $.ajax({
            type:'get',
            data:{'status' : 'deleteall'},
            url:'http://127.0.0.1:8000/user/clearorder',
            datatype:"json",
            success:function(data){
                console.log(data.status);
            }
        })

    })

</script>
@endsection