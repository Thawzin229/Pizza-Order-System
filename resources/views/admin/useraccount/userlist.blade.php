@extends("admin.layouts.extensionforadmin")
@section("title", "User list")



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
                                        <h3>Data - <span class="text-success">{{ $userdata->total() }}</span> </h3>
                                        <div class="ms-5">
                                        
                                        </div>
    
                                    </div>
                                </div>
                                <!-- search bar start -->
                     
                                <!-- search bar end -->
                               
                            </div>
                            <!-- session key  -->
                            <div class="table-responsive table-responsive-data2">


                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>User_Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                      @foreach($userdata as $user)
                                      <tr>
                                        <input type="hidden" name="" id="userid" value="{{ $user['id'] }}">
                                        <td>
                                          @if($user->image === null)
                                          @if($user->gender === "male")
                                          <img src="{{ asset('images/default_user.jpeg') }}" alt="" class="image-fluid">
                                          @else
                                          <img src="{{ asset('images/female.jpg') }}" alt="" class="image-fluid">
                                          @endif
                                          @else
                                          <img src="{{ asset('storage/'.$user['image']) }}" class="image-thumbnail" alt="">
                                          @endif
                                        </td>
                                        <td>{{ $user["name"] }}</td>
                                        <td>{{ $user["email"] }}</td>
                                        <td>{{ $user["address"] }}</td>
                                        <td>{{ $user["phone"] }}</td>
                                        <td>{{ $user["gender"] }}</td>
                                        <td>
                                          <select name="" id="" class="form-control text-center seletionBtn">
                                            <option value="user" @if($user->role == "user")  selected @endif>User</option>
                                            <option value="admin" @if($user->role == "admin")  selected @endif>Admin</option>
                                          </select>
                                        </td>
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


@section("js")
<script>

$(".seletionBtn").change(function(){
  $role  = $(this).val();
  $parent = $(this).parents("tr");
  $userid = $parent.find("#userid").val();
  $data  = { "role" : $role , "userid" : $userid };

  $.ajax({
    type:"get",
    data:$data,
    url:"http://127.0.0.1:8000/userchangerole/change",
    datatype:"json",
    success:function(data){
      if(data.status == "success"){
        window.location.href = "http://127.0.0.1:8000/userchangerole/list";
      }
    }
  })
})

</script>
@endsection