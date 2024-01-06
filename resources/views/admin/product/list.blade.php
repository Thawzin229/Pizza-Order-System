@extends("admin.layouts.extensionforadmin")
@section("title", "list")



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
                                        <h3>Data - <span class="text-success">{{ $products->total() }}</span> </h3>
    
                                    </div>
                                </div>
                                <!-- search bar start -->
                                <div>
                                    <form action="{{ route('product#listPage') }}" method="get">
                                        @csrf
                                        <div class="d-flex">
                                        <input type="text" name="searchVal" id="" class="form-control col-12" value ="{{ request('searchVal') }}" placeholder= "searching...">
                                        <button class="btn bg-dark text-light px-2">search</button>
                                        </div>
                               
                                    </form>
                                </div>
                                <!-- search bar end -->
                                <div class="table-data__tool-right">
                                    <a href="{{ route('product#createPage') }}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add Product Item
                                        </button>  
                                    </a>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        CSV download
                                    </button>  
                                </div>
                            </div>
                            <!-- session key  -->
                            <div class="table-responsive table-responsive-data2">
                              @if(count($products) != 0)

                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                          <th>Image</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>View count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr class="tr-shadow">
                                          <td><img src="{{ asset('storage/'.$item['image']) }}" class="image-thumbnail" alt=""></td>

                                            <td>{{ $item["category_name"] }}</td>
                                            <td>{{ $item["name"] }}</td>
                                            <td>{{ $item["price"] }}</td>
                                            <td>{{ $item["description"] }}</td>
                                            <td>{{ $item["view_count"] }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                
                                                    <a href="{{ route('product#updatePizzaPage', $item['id']) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    </a>
                                                   
                                                    <a href="{{ route('product#deletePizza' ,$item['id'] ) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ route('product#seemorePizza' , $item['id']) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        @endforeach

                                        

                                       
                                    </tbody>
                                </table>
                                        <div class="my-5">{{ $products->appends(request()->query())->links() }}</div>

                               
                                        @else
                                        <h5 class="text-center text-danger">There is no pizza created</h5>
                                        @endif
                            </div>
                        
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- END MAIN CONTENT-->
@endsection