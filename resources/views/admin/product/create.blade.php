@extends("admin.layouts.extensionforadmin")
@section("title", "product creation session")



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
                        <div class="col-lg-8 offset-2">
                            <div class="card p-5">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create your own pizza</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('product#createPizza') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                      @csrf
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="name..." value="{{ old('name') }}">
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Category Id</label>
                                            <select name="category_id" id="" class="form-control">
                                              <option value="">Choose your category</option>
                                              @foreach($categoryData as $item)
                                              <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                              @endforeach
                                            </select>
                                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div>  @enderror


                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1">Description</label>
                                            <textarea name="description" id="" cols="30" rows="5" class="form-control @error('description') is-invalid  @enderror" placeholder="Write something...">{{ old('description') }}</textarea>
                                            @error('description') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>


                                        <div class="form-group">
                                            <label  class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="price..." value="{{ old('price') }}">
                                            @error('price') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>


                                        <div class="form-group">
                                            <label  class="control-label mb-1">image</label>
                                            <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="image...">
                                            @error('image') <div class="invalid-feedback">{{ $message }}</div>  @enderror
                                        </div>
                                        
                                        <div class="my-4">
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
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

            </div>
            <!-- END MAIN CONTENT-->
@endsection