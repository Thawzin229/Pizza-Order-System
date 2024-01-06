@extends("admin.layouts.extensionforadmin")
@section("title", "update session")



@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">

                <div class="section__content section__content--p30">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('product#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-12 p-4 ">
                            <div class="card p-4 bg-light">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update your Pizza Information</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('product#updatePizza') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                        <div class="row p-4 d-flex justify-content-between align-items-center">
                                      <div class="col-4">


<img src="{{ asset('storage/'.$editPizzaData['image']) }}"class = "image-thumbnail  " alt=""/>

    <input type="file" name="image" id="" class="form-control mt-3 @error('image') is-invalid  @enderror">
    @error('image') <div class="invalid-feedback">{{ $message }}</div>  @enderror


</div>
<div class="col-7">
<div class="form-group">
  <input type="hidden" name="idforupdate" id="" value = "{{ $editPizzaData['id'] }}">
                                            <label  class="control-label mb-1 ">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="name..." value="{{old('name' , $editPizzaData['name'])}}">
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="price..." value="{{old('price' , $editPizzaData['price'])}}">
                                            @error('price') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">description</label>
                                            <input id="cc-pament" name="description" type="text" class="form-control @error('description') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="description..." value="{{old('description' , $editPizzaData['description'])}}">
                                            @error('description') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Category Pizza</label>
                                            <select name="category_id" id="" class="form-control">
                                              <option value="">Choose your category</option>
                                              @foreach($categoryData as $item)
                                              <option value="{{ $item['id'] }}" @if($editPizzaData['category_id'] == $item['id']) selected @endif>{{ $item['name'] }}</option>
                                              @endforeach
                                            </select>
                                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div>  @enderror


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
 
            </div>
            <!-- END MAIN CONTENT-->
@endsection