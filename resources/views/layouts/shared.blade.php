<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    {{-- lay outs  --}}
    <div class="container-fluid shadow-lg header">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="text-center"><a href="index.html" class="h3 text-white text-decoration-none">Book Review App</a></h1>
                <div class="d-flex align-items-center navigation">
                    <a href="{{route('account.login')}}" class="text-white">Account</a>                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @auth
                <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                     Welcome, {{ Auth::user()->name }}                  
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{asset('uploads/images/' .Auth::user()->image)}}" class="img-fluid rounded-circle" alt="Luna John">                            
                        </div>
                        <div class="h5 text-center">
                            <strong>Welcome, {{ Auth::user()->name }}</strong>
                            <p class="h6 mt-2 text-muted">5 Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
                    <div class="card-header  text-white">
                        Navigation
                    </div>
                    <div class="card-body sidebar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{route('books.index')}}">Books</a>                               
                            </li>
                            <li class="nav-item">
                                <a href="{{route("book.reviews")}}">Reviews</a>                               
                            </li>
                            <li class="nav-item">
                                <a href="{{route('account.profile')}}">Profile</a>                               
                            </li>
                            <li class="nav-item">
                                <a href="{{route('account.myreview')}}">My Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a href="change-password.html">Change Password</a>
                            </li> 
                            <li class="nav-item">
                                <a href="">Logout</a>
                            </li>                           
                        </ul>
                    </div>
                </div>
            </div>
            @endauth
                
            

           @yield('main')
        </div>       
    </div>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   @yield('script')
 </body>
</html>