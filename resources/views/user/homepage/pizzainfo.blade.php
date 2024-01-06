@extends("user.layouts.extensionforuser")

@section("content")
<input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
            <input type="hidden" name="" id="pizzaId" value="{{ $pizzaInfo['id']  }}">
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/'.$pizzaInfo['image']) }}" alt="Image">
                        </div>
                        
                    </div>
              
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizzaInfo['name'] }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">({{ $pizzaInfo['view_count'] }}Reviews)</small>
                    </div>
                    <h5 class="font-weight-semi-bold mb-4">{{ $pizzaInfo['price'] }} Kyats</h5>
                    <h6 class="font-weight-semi-bold mb-4"><i class="zmdi zmdi-eye me-2"></i>{{ $pizzaInfo['view_count'] +1 }}</h6>
                    <p class="mb-4">{{ $pizzaInfo['description'] }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="ordercount">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addtocartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                @foreach($pizzaList as $item)
                  <div class="product-item bg-light" id="product">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/'.$item['image']) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#information' ,$item['id']) }}"><i class="zmdi zmdi-eye"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $item['name'] }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $item['price'] }} Kyats</h5><h6 class="text-muted ml-2"><del>25000 kyats</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    
@endsection

<!-- js section -->
@section("js")
<script>


    //add view count
    $.ajax({
        type:"get",
        data:{"product_id" : $("#pizzaId").val()},
        url:"http://127.0.0.1:8000/user/viewcount",
        datatype:"json",

    });
    //add to cart section
    $("#addtocartBtn").click(function(){
        $userId =  $("#userId").val();
        $pizzaId =  $("#pizzaId").val();
        $ordercount =  $("#ordercount").val();

        $dataformclient = {
            "userId" : $userId,
            "pizzaId" : $pizzaId,
            "ordercount" : $ordercount
        }

        $.ajax({
            type: "get",
            data:$dataformclient,
            url : "http://127.0.0.1:8000/user/ordercount",
            datatype: 'json',
            success:function(data){
                if(data.status == "success"){
                    window.location.href = "http://127.0.0.1:8000/user/home";
                }
            }

        })
    })
</script>
@endsection
<!-- js section -->