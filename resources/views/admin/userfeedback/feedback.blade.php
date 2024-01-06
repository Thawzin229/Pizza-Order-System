@extends("admin.layouts.extensionforadmin")
@section("title", "user Feedback list")



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
                                        <h3>Data - <span class="text-success">{{ $feedback->total() }}</span> </h3>
    
                                    </div>
                                </div>
                               
                            </div>
                            <!-- session key  -->
                            <div class="table-responsive table-responsive-data2">


                                    <table class="table table-data2 text-center" id="tablelist">
                                    <thead>
                                        <tr>
                                          <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                      @foreach($feedback as $item)
                                      <tr>
                                        <td>{{ $item["name"] }}</td>
                                        <td>{{ $item["email"] }}</td>
                                        <td>{{ $item["message"] }}</td>
                                        <td>
                                                <div class="table-data-feature">
                                                

                                                   
                                                    <a href="{{ route('admin#deleteFeedback' ,$item['id'] ) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    </a>
                                                 
                                                </div>
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


