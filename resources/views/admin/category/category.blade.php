@extends('admin.admin_master')

@section('admin')

<h1>Brands</h1>

<div class="container">


    {{-- Add brands --}}
    <a href="{{ route('category.add') }}" type="button" class="btn-btn-info">Add New Category</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Category
    </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                {{-- using same blade for store & edit --}}
                @if (isset($brand))
                    <form action="{{ route('brands.edit', $brand->id) }}" method="POST" id="commentForm">
                        @method('PUT')
                @else
                    <form action="{{ route('brands.new') }}" method="POST" id="commentForm" enctype="multipart/form-data">
                @endif
                  @csrf
                  <h1>@if (isset($brand)) Edit @else Add @endif brands</h1>

                  <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                    <input type="text" class="form-control text-center" id="exampleFormControlInput1" style="border: 2px solid black" name="brand_name" value="{{ old('brand_name', $brand->brand_name ?? '') }}" required>
                  </div>
                  {{-- username --}}
                  <div class="mb-3 mt-3">
                    <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                    <input type="file" class="form-control text-center" id="photo" style="border: 2px solid black" name="brand_image" value="{{ old('brand_image', $brand->brand_image ?? '') }}" required>
                    <img id="showPhoto" src="{{url('upload/admin-photo/blank.jpg')}}" class="rounded-circle avatar-x1 card-img-top" alt="..." style="width: 18rem">

                  </div>
  
                  {{-- <button type="submit" class="btn btn-success">Add this Brand</button> --}}
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                  </div>
                </form>
            
              </div>
        </div>
       
      </div>
    </div>
  </div>

  {{-- datatable --}}
    <div class="card">
        <div class="card-body">
            <table id="dataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td><img src="{{ asset($brand->brand_image) }}" alt="" style="width: 70px; height:40px">{{$brand->brand_image}}</td>
                            <td>
                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-info">Edit</a>
                    
                                <a href="{{ route('brands.delete', $brand->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        
                    @endforeach
                    
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
    </div>
</div>


<script>
    $("#commentForm").validate({
  rules: {
    brand_name: "required",
    brand_image: "required",
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    brand_name: "The brand name is needed!",
    brand_image: "Please insert an image!",
    email: {
      required: "We need your email address to contact you",
      email: "Your email address must be in the format of name@domain.com"
    }
  }
});
</script>    
@endsection