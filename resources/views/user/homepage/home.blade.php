@extends("user.layouts.extensionforuser")


@section("content")
<div class="container-fluid">
@if(session("updatesuccess"))
                            <div class="alert alert-success alert-dismissible fade show col-6 offset-4 text-center" role="alert">
                                {{ session("updatesuccess") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                            @endif
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                    <div class="custom-control d-flex align-items-center justify-content-between">
                        <a class="text-dark" href="{{ route('user#home') }}">
                        <label class="custom-control-label text-uppercase text-bold" for="price-5"> All Category</label>

                        </a>
                            <span class="">{{ count($category) }}</span>
                        </div>
                        @foreach($category as $item)
                        <div class=" my-4">
                            <a id="categorylink" class="text-dark" href="{{ route('user#filter', $item['id']) }}">
                            <label class="text-uppercase text-bold" for="price-5">{{ $item['name'] }}</label>
                            </a>
                        </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

              
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                <a href="{{ route('user#cart') }}">
                                <button type="button" class="btn btn-primary position-relative">
                                <i class="zmdi zmdi-pizza"></i>

  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    {{ count($cart) }}
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
                                </a>
                                </div>
                                <div>
                                <a href="{{ route('user#orderhistorty') }}">
                                <button type="button" class="btn btn-primary position-relative">
                                <i class="zmdi zmdi-calendar"></i>


  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    {{ count($orderdata) }}
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
                                </a>
                            </div>
                            </div>

                      
                            <div class="ml-2">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> -->
                                    <select name="sorting" id="sortingBtn">
                                        <option value="">sorting</option>
                                        <option value="asec">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <span class="row" id="productList">
                @if(count($pizza) != 0)
                @foreach($pizza as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
                            <div class="product-item bg-light mb-4" id="productContainer">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/' . $item['image']) }}" alt="" id="pizzaImage">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('user#information',$item['id']) }}"><i class="zmdi zmdi-eye"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $item["name"] }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $item["price"] }} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h3 class="text-danger text-center">'nothing found</h3>
                @endif

                        </span>
                        


                  
               
                </div>
                <div>
                          {{ $pizza->links() }}
                        </div>
                        @if(session("permission"))
                        <h6 class="text-danger text-center">You have no permission to enter admin page</h6>
                        @endif
            </div> 
            <!-- Shop Product End -->
        </div>
    </div>


@endsection

<!-- js section -->
@section("js")
<script>
   
    $("#sortingBtn").change(function(){
        let $value =  $("#sortingBtn").val();
        if($value == "asec"){
            $.ajax({
        type:"get",
        data:{"status":"asc"},
        url:"http://127.0.0.1:8000/user/ajaxdata",
        datatype:"json",
        success:function(data1){
            $list  = "";
            for (let $i = 0; $i < data1.length; $i++) {
                $list += `  <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
                            <div class="product-item bg-light mb-4" id="productContainer">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/${data1[$i].image}') }}" alt="" id="pizzaImage">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="zmdi zmdi-eye"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data1[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data1[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    $("#productList").html($list);

        }
    })
        }else if($value == "desc"){
            $.ajax({
        type:"get",
        data:{"status":"desc"},
        url:"http://127.0.0.1:8000/user/ajaxdata",
        datatype:"json",
        success:function(data2){
            $list  = "";
            for (let $i = 0; $i < data2.length; $i++) {
                $list += `  <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
                            <div class="product-item bg-light mb-4" id="productContainer">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{ asset('storage/${data2[$i].image}') }}" alt="" id="pizzaImage">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="zmdi zmdi-eye"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${data2[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${data2[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    $("#productList").html($list);

        }
    })
        }
    })
</script>
@endsection
<!-- js section -->