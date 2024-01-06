@extends("admin.layouts.extensionforadmin")
@section("title", "product list")



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
    
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card w-50 p-4 shadow">
                              <div class="card-body">
                                <h4>order information</h4>
                                <hr>

                              <div class="d-flex justify-content-between my-3">
                                <p>Name <i class="zmdi zmdi-account-o ms-2"></i></p>
                                <p>{{ $productList[0]["user_name"] }}</p>
                              </div>

                              <div class="d-flex justify-content-between my-3">
                                <p>Order_Code <i class="zmdi zmdi-code ms-2"></i></p>
                                <p>{{ $productList[0]["ordercode"] }}</p>
                              </div>

                              <div class="d-flex justify-content-between my-3">
                                <p>Phone_Number <i class="zmdi zmdi-phone-in-talk ms-2"></i></p>
                                <p>{{ $productList[0]["user_phone"] }}</p>
                              </div>

                              <div class="d-flex justify-content-between my-3">
                                <p>Total Price <i class="zmdi zmdi-label ms-2"></i></p>
                                <p>{{ $ordercodeforTotalPrice['totalprice']}}</p>
                              </div>
                              </div>

                            </div>
                            <!-- session key  -->
                            <div class="table-responsive table-responsive-data2">


                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>User Name</th>
                                            <th>Product Name</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                      @foreach($productList as $item)
                                      <tr class="tr-shadow">
                                            <td><img src="{{ asset('storage/'.$item['product_image']) }}" class="shadow img-thumbnail" alt=""></td>
                                            <td>{{ $item["user_name"] }}</td>
                                            <td>{{ $item["product_name"] }}</td>
                                            <td>{{ $item["created_at"]->format('d-m-Y') }}</td>
                                            
                                        </tr>
                                        <tr class="spacer"></tr>
                                      @endforeach
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

