@extends("user.layouts.extensionforuser")
@section("content")
 <!-- Cart Start -->
 <div class="container-fluid">
        <div class="row px-xl-5 d-flex justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="table" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Customer_Order_Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      @foreach($orderhistorydata as $item)
                      <tr>
                      <td class="align-middle">{{ $item['created_at']->format("d-m-Y") }}</td>
                      <td class="align-middle">{{ $item['ordercode'] }}</td>
                      <td class="align-middle">{{ $item['totalprice'] }}</td>
                      <td class="align-middle">
                        @if($item['status'] == "0")
                        <span class="text-info">pending ...<i class="zmdi zmdi-rotate-left ms-1"></i></span>
                        @elseif($item['status'] == "1")
                         <span class="text-success">ordered<i class="zmdi zmdi-check-circle ms-3"></i></span> 
                        @elseif($item['status'] == "2")
                        <span class="text-danger">canceled<i class="zmdi zmdi-alert-circle ms-3"></i></span>
                        @endif
                      </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="ms-5 mt-4">{{ $orderhistorydata->links() }}</div>
                </div>
        
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section("js")

@endsection