@extends('layouts.shared')
@section('main')
 <div class="col-md-9">
        <div class="card border-0 shadow">
            <div class="card-header  text-white">
                 Edit Review
             </div>
            <form action="{{route('account.myreview.updateMyReview',$review->id)}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="author" class="form-label">Review</label>
                        <textarea  name="review" id="review" class="form-control   @error('review') is-invalid    @enderror " placeholder="Add Review" cols="30" rows="5">{{ old('review', $review->review) }}</textarea>
                        @error('review')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1" {{($review->rating == 1) ? 'selected' : ''}}>1</option>
                            <option value="2" {{($review->rating == 2) ? 'selected' : ''}}>2</option>
                            <option value="3" {{($review->rating == 3) ? 'selected' : ''}}>3</option>
                            <option value="4" {{($review->rating == 4) ? 'selected' : ''}}>4</option>
                            <option value="5" {{($review->rating == 5) ? 'selected' : ''}}>5</option>
                        </select>
                    </div>
                    <button class="btn btn-primary mt-3">Update</button>                     
                </div>
            </form>
        </div>                
</div>

@endsection
