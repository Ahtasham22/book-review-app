<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
   public function reviews(){
    $review = Review::with('book')->orderBy('created_at' , 'DESC')->paginate(10);
    return view('reviews.list',[
        'review' =>$review
    ]);
   }

   public function editReview($id){
    $review = Review::findOrFail($id);
    return view('reviews.edit',[
        'review' => $review
    ]);
   }

   public function updateReview($id, Request $request){
    $review = Review::findOrFail($id);
    $validator = Validator::make($request->all(),[
        'review' => 'required',
        'status' => 'required'
    ]);
    if($validator->fails()){
        return redirect()->route('reviews.editReview',$id)->withInput()->withErrors($validator);
    }

    $review->review = $request->review;
    $review->status = $request->status;
    $review->save();
    return redirect()->route('book.reviews')->with('success','review  updated successfully');
   }

   public function deleteReview(Request $request){
    $id = $request->id;
    $review = Review::find($request->id);
    if($review == null){
        session()->flash('error','Review Not Found');
        return response()->json([
            'status' => false,
        ]);
    }else{
        $review->delete();
         session()->flash('success','Review Deleted Successfully');
         return response()->json([
            'status' => true,
         ]);
    }
   }

}
