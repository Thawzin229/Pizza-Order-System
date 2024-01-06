@extends("admin.layouts.extensionforadmin")
@section("title", "category list")



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
                                        <h3>Data - <span class="text-success">{{ $categoriesData->total() }}</span> </h3>
    
                                    </div>
                                </div>
                                <!-- search bar start -->
                                <div>
                                    <form action="{{ route('admin#categorylist') }}" method="get">
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
                            @if(session("updatedacc"))
                            <div class="alert alert-success alert-dismissible fade show col-4 offset-4 text-center" role="alert">
                                {{ session("updatedacc") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                            @endif
                            <div class="table-responsive table-responsive-data2">
                                @if(count($categoriesData) != 0)
                                    <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Name</th>
                                            <th>Created Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categoriesData as $item)
                                        <tr class="tr-shadow">
                                          <td>{{ $item["id"] }}</td>
                                            <td>{{ $item["name"] }}</td>
                                            <td>{{ $item["created_at"]->format("d-m-Y") }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </button>
                                                    <a href="{{ route('admin#editPage' ,$item['id'] ) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    </a>
                                                   
                                                    <a href="{{ route('admin#delete' ,$item['id'] ) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    </a>
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        @endforeach

                                        

                                       
                                    </tbody>
                                </table>
                                @else
                                <h4 class="text-center text-muted my-5">There is no datas named as <span class="text-danger">' {{  request('searchVal') }} ' </span> , try again...</h4>
                                @endif
                            </div>
                            <div class="my-5 text-dark">
                                {{ $categoriesData->appends(request()->query())->links() }}
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
                @if(session('permission'))
  <h5 class="text-danger text-center my-5">{{ session('permission') }}</h5>
  @endif
  @if(session('permissiontologin'))
  <h5 class="text-danger text-center my-5">{{ session('permissiontologin') }}</h5>
  @endif
            </div>
            <!-- END MAIN CONTENT-->
@endsection