<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function home(){
    $books = Book::orderBy('created_at','DESC')->where('status' , 1)->get();
    return view('home',[
        'books' => $books
    ]);
  }

  public function bookDetail($id){
    $book = Book:: with('reviews','reviews.user')->findOrFail($id);
    $related = Book::where('status',1)->where('id','!=',$id )->take(3)->inRandomOrder()->get();
    return view('books.detail',[
        'book' =>$book,
        'related' =>$related
    ]);
  }

  public function saveReview(Request $request){
    $validator = Validator::make($request->all(),[
      'review' => 'required',
      'rating' => 'required'
    ]);
    if($validator->fails()){
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }

    $review = new Review();
    $review->review = $request->review;
    $review->rating = $request->rating;
    $review->user_id = Auth::user()->id;
    $review->book_id = $request->book_id;
    $review->save();

   return response()->json([
        'status' => true,
      ]);
  }
  
}
