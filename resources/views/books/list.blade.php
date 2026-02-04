 @extends('layouts.shared')
 @section('main')
 
  {{-- show books here  --}}

            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Books
                    </div>
                    <div class="card-body pb-0">    
                        <div class="d-flex justify-content-between">
                             <a href="{{route('books.create')}}" class="btn btn-primary">Add Book</a>  
                            <form action="" method="GET">
                             <div class="d-flex">
                                <input type="text" placeholder="Keyword" name="keyword">
                                <button type="submit btn btn-primary ms-2">Search</button>
                               </div>         
                            </form>     
                        </div>        
                       
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                           <td>{{$book->title}}</td>
                                           <td>{{$book->author}}</td>
                                           <td>3.0 (3 Reviews)</td>
                                            @if ($book->status == '1')
                                                <td>Active</td> 
                                             @else
                                                <td>Block</td>   
                                            @endif
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                            <a href="{{route('books.edit',$book->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="deleteBook({{$book->id}})" href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </thead>
                        </table>   
                        <nav aria-label="Page navigation " >
                            <ul class="pagination">
                              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>                  
                    </div>
                </div>                
            </div>
@endsection

<script>
 function deleteBook(id) {
    if (confirm("Are you sure you want to delete the book?")) {
        $.ajax({
            url: '{{ route("book.delete") }}',
            type: 'POST',
            data: {
                id: id,
                _method: 'DELETE'
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                alert("Book deleted successfully!");
                window.location.reload(true);
            },
            error: function(xhr, status, error) {
                console.error('Delete failed:', error);
                alert('Something wrong while deleting the book');
            }
        });
    }
}

</script>