 @extends('layouts.shared')
 @section('main')
       <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Add Book
                    </div>
                    <div class="card-body">
                        <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control " placeholder="Title" name="title" id="title" />
                        @error('title')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" placeholder="Author"  name="author" id="author"/>
                        @error('author')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" class="form-control" placeholder="Description" cols="30" rows="5"></textarea>
                         @error('desc')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" class="form-control"  name="image" id="image"/>
                         @error('image')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                        </div>


                        <button class="btn btn-primary mt-2">Create</button>    
                        </form>                 
                    </div>
                </div>                
            </div>     
@endsection