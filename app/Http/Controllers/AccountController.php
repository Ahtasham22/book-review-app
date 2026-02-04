<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class AccountController extends Controller
{
    // this method will show  register form 
    public function register(){
        return view('account.register');
    }

    // this method will register user in database 

    public function processRegister(Request $request){
     
    $validator= Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
    ]);
    if($validator->fails()){
        return redirect()->route('account.register')->withInput()->withErrors($validator);
    }
     $user = new User();
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = Hash::make($request ->password);
     $user->save();
    
    return redirect()->route('account.login')->with('success','you have register successfully');
   
    }

    public function login(){
       return view('account.login');
    }

    public function authentication(Request $request){
     $validator= Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if($validator->fails()){
        return redirect()->route('account.login')->withInput()->withErrors($validator);
    }
     if(Auth::attempt([
        'email' => $request->email,
        'password' =>$request->password
     ])){
 return redirect()->route('account.profile')->with('success','successfully log in');
     }
    
    }
    public function profile(){
        $user = User::find(Auth::user()->id);
        return view ('account.profile',[
           'user' => $user,
        ]);
    }
    public function updateProfile(Request $request){
      $rule =[
        'name' => 'required',
        'email' => 'required'
      ];
      $validator = Validator::make($request->all(),$rule);
      if($validator->fails()){
        return redirect()->route('account.profile')->withInput()->withErrors($validator);
      }

      if(!empty($request->image)){
        $rule['image'] = 'image';
      }

      $user = User::find(Auth::user()->id);
      $user->name = $request->name;
      $user->email = $request->email;
      $image = $request->image;
      $exe = $image->getClientOriginalExtension();
      $imageName = time(). '.' .$exe;
      $image->move(public_path('uploads/images'),$imageName);
      $user->image = $imageName;
      $user->save();
      return redirect()->route('account.profile')->with('success','Successfully updated');
    }

    public function myReview(){
      $review = Review::with('book')->where('user_id', Auth::user()->id)->orderBy('created_at' , 'DESC')->paginate(5);
      return view ('account.myreview',[
        'review' => $review
      ]);
    }
    public function editReview($id){
      $review = Review::where([
        'id' => $id,
        'user_id' =>Auth::user()->id
      ])->first();
      return view('account.myreview-edit',[
        'review' => $review
      ]);
    }

  public function updateMyReview($id, Request $request){
    $review = Review::findOrFail($id);
    $validator = Validator::make($request->all(),[
        'review' => 'required',
        'rating' => 'required'
    ]);
    if($validator->fails()){
        return redirect()->route('account.myreview-edit',$id)->withInput()->withErrors($validator);
    }
    $review->review = $request->review;
    $review->rating = $request->rating;
    $review->save();
    return redirect()->route('account.myreview')->with('success','review  updated successfully');
   }

    public function deleteMyReview(Request $request){
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
