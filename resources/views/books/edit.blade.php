@extends('layouts.shared')
@section('main')
 <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Edit Book
                    </div>
                    <form action="{{route('book.update',$book->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input value="{{old('title', $book->title)}}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" />
                            @error('title')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input value="{{old('author', $book->author)}}" type="text" class="form-control  @error('author') is-invalid @enderror" placeholder="Author"  name="author" id="author"/>
                            @error('author')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Description</label>
                            <textarea   name="desc" id="desc" class="form-control" placeholder="Description" cols="30" rows="5">{{$book->desc}}</textarea>
                            @error('desc')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image" id="image"/>
                            <br>
                            <img src="{{asset("uploads/books/".$book->image)}}" alt="" class="w-25">
                             @error('image')
                               <p class="invalid-feedback">{{$message}}</p>
                             @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{($book->status == 1) ? 'selected' : ''}}>Active</option>
                                <option value="0" {{($book->status == 0) ? 'selected' : ''}}>Block</option>
                            </select>
                        </div>
                        
                        <button class="btn btn-primary mt-3">Update</button>                     
                    </div>
                    </form>
                </div>                
            </div>

@endsection