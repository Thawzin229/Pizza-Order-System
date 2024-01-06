@extends("admin.layouts.extensionforadmin")
@section("title", "Account Update session")



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
                        <div class="col-lg-12 p-4 ">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update your account</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin#updateAcc') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                        <div class="row p-4">
                                      <div class="col-4">

@if(Auth::user()->image == null)
            @if(Auth::user()->gender =="male")
                                                    <img src="{{ asset('images/default_user.jpeg') }}" alt="" class="image-fluid">
                                                    @else
                                                    <img src="{{ asset('images/female.jpg') }}" alt="" class="image-fluid">
                                                    @endif
@else
<a href="#">
<img src="{{ asset('storage/' .Auth::user()->image) }}"class = "image-thumbnail mt-5"/>

    </a>
    @endif
    <input type="file" name="image" id="" class="form-control mt-3">

</div>
<div class="col-7 offset-1">
<div class="form-group">
                                            <label  class="control-label mb-1 ">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="name..." value="{{old('name' , Auth::user()->name)}}">
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="email..." value="{{old('email' , Auth::user()->email)}}">
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="phone..." value="{{old('phone' , Auth::user()->phone)}}">
                                            @error('phone') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="male" @if(Auth::user()->gender == "male") selected @endif >Male</option>
                                                <option value="female" @if(Auth::user()->gender == "female") selected @endif>Female</option>
                                            </select>
                                            @error('male') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="address..." value="{{old('address' , Auth::user()->address)}}">
                                            @error('address') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="role..." disabled value="{{old('role' , Auth::user()->role)}}">
                                            @error('role') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
</div>
</div>
<div class="text-center"><a href=""><button class="btn btn-success px-5">Update</button></a></div>
                                      </form>
                                     
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