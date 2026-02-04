@extends('layouts.shared')
@section('main')
        <div class="col-md-9">
                
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        My Reviews
                    </div>
                    <div class="card-body pb-0">            
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Book</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                    <th>Status</th>                                  
                                    <th width="100">Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($review as $review)
                                          <tr>
                                        <td>{{$review->book->title}}</td>
                                        <td>{{$review->review}}</td>                                        
                                        <td>{{$review->rating}}</td>
                                        @if ($review->status == 1)
                                             <td class="text-success">Active</td>
                                        @else
                                              <td class="text-danger">Block</td>
                                        @endif
                                       
                                        <td>
                                            <a href="{{route('account.myreview.edit',$review->id)}}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="deleteMyReview({{$review->id}})" href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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

    @section('script')
<script>
    function deleteMyReview(id){
        if(confirm('are you sure you want to delete review')){
            $.ajax({
                url : '{{route("reviews.deleteReview")}}',
                type : 'POST',
                data : {id:id},
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                success : function(response){
                    window.location.href = '{{route("account.myreview")}}'
                }
            })
        }
    }
</script>
@endsection
@endsection