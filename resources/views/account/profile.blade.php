@extends('layouts.shared')
 @section('main')
            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Profile
                    </div>
                    <div class="card-body">
                        <form action="{{route('account.updateProfile')}}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', Auth::user()->name)}}" class="form-control @error('name') is-invalid  @enderror" placeholder="Name" name="name" id="" />
                              @error('name')
                                 <p class="invalid-feedback">{{$message}}</P>
                              @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="text" value="{{ old('email', Auth::user()->email)}}" class="form-control @error('email') is-invalid  @enderror" placeholder="Email"  name="email" id="email"/>
                             @error('email')
                                <p class="invalid-feedback">{{$message}}</P>
                             @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid  @enderror">
                            <img src="images/profile-img-1.jpg" class="img-fluid mt-4" alt="Luna John" >
                              @error('image')
                                <p class="invalid-feedback">{{$message}}</P>
                              @enderror
                        </div>   
                        <button class="btn btn-primary mt-2">Update</button>    
                       </form>                 
                    </div>
                </div>                
            </div>
@endsection
         