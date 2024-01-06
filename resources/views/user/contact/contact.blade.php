@extends("user.layouts.extensionforuser")
@section("content")
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-8">
      <div class="bg-light shadow p-5">
        <h4 class="text-center">Contact Us <i class="zmdi zmdi-email"></i></h4>
        <form action="{{ route('user#Message') }}" method="post">
          @csrf
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="email..." value="">
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="name..." value="">
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Message</label>
                                            <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="write your feedback..."></textarea>
                                            @error('message') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="text-center mt-5"><button class="btn btn-primary px-5">Send</button></div>

                                        
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
