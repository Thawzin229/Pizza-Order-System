@extends("user.layouts.extensionforuser")
@section("title", "password changing session")



@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">

                <div class="section__content section__content--p30">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-4 offset-7">
                                <a href="{{ route('user#home') }}"><button class="btn bg-warning text-dark px-4 my-3"> <i class="zmdi zmdi-arrow-left"></i> Back to List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                                      @csrf
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid  @enderror  @if(session('error')) is-invalid @endif" aria-required="true" aria-invalid="false" placeholder="old password...">
                                            @error('oldpassword') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                            @if(session("error"))
                                            <div class="invalid-feedback">{{ session('error') }}</div> 
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newpassword" type="password" class="form-control @error('newpassword') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="newpassword...">
                                            @error('newpassword') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="passwordConfirm" type="password" class="form-control @error('passwordConfirm') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="confirmpassword...">
                                            @error('passwordConfirm') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg bg-warning text-dark btn-block" id="">
                                                <span id="payment-button-amount">Change Password</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
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