@extends("admin.layouts.extensionforadmin")
@section("title", "change admin role session")



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
                                        <h3 class="text-center title-2">Update your role</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin#updateRole' , $roleData['id']) }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                        <div class="row p-4 d-flex justify-content-center align-items-center">
                                      <div class="col-4">

@if($roleData['image'] == null)
            @if($roleData['gender'] =="male")
                                                    <img src="{{ asset('images/default_user.jpeg') }}" alt="" class="image-fluid">
                                                    @else
                                                    <img src="{{ asset('images/female.jpg') }}" alt="" class="image-fluid">
                                                    @endif
@else
<a href="#">
<img src="{{ asset('storage/' . $roleData['image']) }}"class = "image-thumbnail mt-5"/>

    </a>
    @endif
    <input type="file" name="image" id="" class="form-control mt-3">

</div>
<div class="col-7 offset-1">
<div class="form-group">
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Role</label>
                                            <select name="role" id="" class="form-control">
                                              <option value="admin" @if($roleData['role'] == "admin") selected @endif>Admin</option>
                                              <option value="user"  @if($roleData['role'] == "user") selected @endif>User</option>
                                            </select>
                                            @error('role') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
</div>
</div>
<div class="text-center"><a href=""><button class="btn btn-success px-5">Save</button></a></div>
                                      </form>
 
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
            <!-- END MAIN CONTENT-->
@endsection