@extends("admin.layouts.extensionforadmin")
@section("title", "account session")



@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">

                <div class="section__content section__content--p30">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('admin#categorylist') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-12 p-4">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Infomation</h3>
                                    </div>
                                    <hr>
                                    <div class="row p-4 d-flex justify-content-center align-items-center">
                                      <div class="col-4">

                                                @if(Auth::user()->image == null)
                                                @if(Auth::user()->gender =="male")
                                          <img src="{{ asset('images/default_user.jpeg') }}" alt="" class="image-fluid">
                                          @else
                                          <img src="{{ asset('images/female.jpg') }}" alt="" class="image-fluid ">
                                          @endif
                                                @else
                                               
                                                <img src="{{ asset('storage/' .Auth::user()->image) }}"class = "image-thumbnail mt-5 shadow border"/>

                                                    
                                                    @endif

                                      </div>
                                      <div class="col-7 offset-1">
                                      <h4 class="text-muted  my-4">id - <span class="text-dark">{{ Auth::user()->id }}</span></h4>
                                        <h4 class="text-muted  my-4">Name - <span class="text-dark">{{ Auth::user()->name }}</span></h4>
                                        <h4 class="text-muted  my-4">Email - <span class="text-dark">{{ Auth::user()->email }}</span></h4>
                                        <h4 class="text-muted  my-4">Address - <span class="text-dark">{{ Auth::user()->address }}</span></h4>
                                        <h4 class="text-muted  my-4">Phone_number - <span class="text-dark">{{ Auth::user()->phone }}</span></h4>
                                        <h4 class="text-muted  my-4">Gender - <span class="text-dark">{{ Auth::user()->gender }}</span></h4>
                                        <h4 class="text-muted  my-4">Member Since - <span class="text-dark">{{ Auth::user()->created_at->format('d-M-Y') }}</span></h4>
                                      </div>
                                    </div>
                                    <div class="text-center"><a href="{{ route('admin#accountUpdatePage') }}"><button class="btn btn-success px-5">Edit</button></a></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                @if(session('permission'))
  <h5 class="text-danger text-center my-5">{{ session('permission') }}</h5>
  @endif
            </div>
            <!-- END MAIN CONTENT-->
@endsection