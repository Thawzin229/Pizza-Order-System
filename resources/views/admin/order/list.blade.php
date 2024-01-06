@extends("admin.layouts.extensionforadmin")
@section("title", "order list")



@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h3>Data - <span class="text-success">{{ $orderList->total() }}</span> </h3>
                                        <div class="ms-5">
                                          <form action="{{ route('admin#orderSorting') }}" method="get" class="d-flex">
                                            @csrf
                                          <select name="orderstatus" id="sortingBtn" class="form-control text-center border shadow px-4">
                                            <option value="all" @if(request('orderstatus') == "all") selected @endif>All</option>
                                            <option value="0" @if(request('orderstatus') == "0")  selected @endif>pending</option>
                                            <option value="1" @if(request('orderstatus') == "1")  selected @endif>ordered</option>
                                            <option value="2" @if(request('orderstatus') == "2")  selected @endif>canceled</option>
                                          </select>
                                          <button class="selectionBtn">sorting</button>
                                          </form>
                                        </div>
    
                                    </div>
                                </div>
                                <!-- search bar start -->
                            <div class="me-5">
                            <div class="me-5">
                                    <form action="{{ route('admin#orderList') }}" method="get">
                                        @csrf
                                        <div class="d-flex">
                                        <input type="text" name="searchVal" id="" class="form-control col-12" value ="{{ request('searchVal') }}" placeholder= "searching...">
                                        <button class="searchBtn">search</button>
                                        </div>
                               
                                    </form>
                                </div>
                            </div>
                                <!-- search bar end -->
                               
                            </div>
                            <!-- session key  -->
                            <div class="table-responsive table-responsive-data2">


                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                          <th>User_Id</th>
                                            <th>User_Name</th>
                                            <th>Order_Code</th>
                                            <th>Total Price</th>
                                            <th>Date</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                      @if(count($orderList) != null)
                                      @foreach($orderList as $item)
                                      <tr class="tr-shadow">
                                        <input type="hidden" name="" value="{{ $item['id'] }}" id="orderid">
                                            <td>{{ $item["user_id"] }}</td>
                                            <td>{{ $item["username"] }}</td>
                                            <td><a href="{{ route('admin#orderProductList' , $item['ordercode']) }}">{{ $item["ordercode"] }}</a></td>
                                            <td>{{ $item["totalprice"] }} Kyats</td>
                                            <td>{{ $item["created_at"]->format('d-m-Y') }}</td>
                                            <td>
                                              <select name="" class="form-control text-center border shadow seletionBtn" id="">
                                                <option value="0" @if($item['status'] == 0) selected @endif>pending</option>
                                                <option value="1" @if($item['status'] == 1) selected @endif>ordered</option>
                                                <option value="2" @if($item['status'] == 2) selected @endif>canceled</option>
                                              </select>
                                            </td>
                                            
                                        </tr>
                                        <tr class="spacer"></tr>
                                      @endforeach
                                      @else
                                      <div class="text-center text-danger">nothing found</div>
                                      @endif
                                        

                                       
                                    </tbody>
                                </table>


                               
                            </div>
                        
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- END MAIN CONTENT-->
@endsection


@section("js")
<script>
  // seletion
  $(".seletionBtn").change(function(){
    $status = $(this).val();
    $parentTr =$(this).parents('tr');
    $orderId = $parentTr.find("#orderid").val();
    $data = {"orderid" : $orderId , "status" : $status};


    $.ajax({
      type:"get",
      data:$data,
      url:'http://127.0.0.1:8000/order/changestatus',
      datatype:"json",
      success:function(data){
        if(data.status == "success"){
          window.location.href = "http://127.0.0.1:8000/order/list";
        }
      }
    })
  })
 
  
</script>
@endsection