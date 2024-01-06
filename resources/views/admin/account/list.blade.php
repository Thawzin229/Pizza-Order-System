@extends("admin.layouts.extensionforadmin")
@section("title", "Admin Account list")



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
                                        <h3>Data - <span class="text-success">{{ $data->total() }}</span> </h3>
    
                                    </div>
                                </div>
                        
                                <!-- search bar start -->
                                <div>
                                    <form action="{{ route('admin#listOfAdmin') }}" method="get">
                                        @csrf
                                        <div class="d-flex">
                                        <input type="text" name="searchVal" id="" class="form-control col-12" value ="{{ request('searchVal') }}" placeholder= "searching...">
                                        <button class="btn bg-dark text-light px-2">search</button>
                                        </div>
                               
                                    </form>
                                </div>
                                <!-- search bar end -->
                                <div class="table-data__tool-right">
                                    <a href="{{ route('admin#createPage') }}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add Category Item
                                        </button>  
                                    </a>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        CSV download
                                    </button>  
                                </div>
                            </div>
                            <!-- session key  -->
                            @if(session("deletesuccess"))
                            <div class="alert alert-danger alert-dismissible fade show col-4 offset-4 text-center" role="alert">
                                {{ session("deletesuccess") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                            @endif
                       
                            <div class="table-responsive table-responsive-data2">

                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                            <th>image</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr class="tr-shadow">
                                          <td>
                                          @if($item["image"] == null)
                                          @if($item["gender"]=="male")
                                          <img src="{{ asset('images/default_user.jpeg') }}" alt="" class="image-fluid">
                                          @else
                                          <img src="{{ asset('images/female.jpg') }}" alt="" class="image-fluid">
                                          @endif
                                          @else
                                          <img src="{{ asset('storage/'.$item['image']) }}" class="image-thumbnail" alt="">
                                          @endif
                                          </td>

                                            <td>{{ $item["id"] }}</td>
                                            <td>{{ $item["name"] }}</td>
                                            <td>{{ $item["gender"] }}</td>
                                            <td>{{ $item["email"] }}</td>
                                            <td>{{ $item["phone"] }}</td>
                                            <td>{{ $item["address"] }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                
                                                   
                                                   @if($item["id"] == Auth::user()->id)

                                                   @else
                                                    <a href="{{ route('admin#delete' ,$item['id'] ) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ route('admin#changerole', $item['id']) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    </a>
                                                    @endif
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        @endforeach


                                    </tbody>
                                </table>
                              
                            </div>
                            @if(session("changedrole"))
                            <div class="alert alert-success my-5 alert-dismissible fade show col-4 offset-4 text-center" role="alert">
                                {{ session("changedrole") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                            @endif
                            <div class="my-5 text-dark">
                              {{$data->appends(request()->query())->links()}}
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
    
            </div>
            <!-- END MAIN CONTENT-->
@endsection