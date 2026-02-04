@extends('layouts.shared')
@section('main')
 <div class="col-md-9">
        <div class="card border-0 shadow">
            <div class="card-header  text-white">
                 Edit Review
             </div>
            <form action="{{route('reviews.updateReview',$review->id)}}" method="POST">
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
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{($review->status == 1) ? 'selected' : ''}}>Active</option>
                            <option value="0" {{($review->status == 0) ? 'selected' : ''}}>Block</option>
                        </select>
                    </div>
                    <button class="btn btn-primary mt-3">Update</button>                     
                </div>
            </form>
        </div>                
</div>

@endsection
