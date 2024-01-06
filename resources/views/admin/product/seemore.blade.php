@extends("admin.layouts.extensionforadmin")
@section("title", "information session")



@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">

                <div class="section__content section__content--p30">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('product#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-12 p-4">
                          <div class="card p-4 bg-dark">
                            <div class="card-body">
                                  <button class="btn btn-dark text-light px-4 " onclick="history.back()">back</button>
                                    <div class="card-title">
                                        <h3 class="text-center title-2 text-light">Product Infomation</h3>
                                      </div>
                                    <hr>
                                    <div class="row p-5 d-flex justify-content-between align-items-center">
                                      <div class="col-4">
                                      <img src="{{ asset('storage/'.$seemorePizzaData['image']) }}"class = "image-thumbnail shadow border" alt=""/>
                                      </div>
                                      
                                      <div class="col-7  px-5">

                                        <h4 class="text-muted  my-4">Name - <span class="text-warning">{{ $seemorePizzaData['name'] }}</span></h4>
                                        <h4 class="text-muted  my-4">Name - <span class="text-warning">{{ $seemorePizzaData['category_name'] }}</span></h4>
                                        <h4 class="text-muted  my-4">Price - <span class="text-warning">{{ $seemorePizzaData['price'] }}</span></h4>
                                        <h4 class="text-muted  my-4">Description - <span class="text-warning">{{ $seemorePizzaData['description'] }}</span></h4>
                                        <h4 class="text-muted  my-4">View_Count - <span class="text-warning">{{ $seemorePizzaData['view_count'] }}</span></h4>

                                       

                                      </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
 
            </div>
            <!-- END MAIN CONTENT-->
@endsection