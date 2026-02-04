<?php
 
namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function index(Request $request){
      $books = Book::OrderBy('created_at','Desc');
  
      if(!empty($request->keyword)){
        $books->where('title','like' , '%' .$request->keyword. '%');
      }
          $books = $books->paginate(3);
        return view('books.list',[
          'books' => $books
        ]);
    }
    public function create(){
        return view('books.add');
    }

    public function store(Request $request){
      $rule = [
        'title' => 'required',
        'author' => 'required',
        'status' => 'required'
      ];
      $validator = Validator::make($request->all(),$rule);

      if($validator->fails()){
        return redirect()->route('books.create')->withInput()->withErrors($validator);
      }

      if(!empty($request->image)){
        $rule['image'] = 'image';
      }

      $book = new Book();
      $book->title = $request->title;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->status = $request->status;
      $image = $request->image;
      $exe = $image->getClientOriginalExtension();
      $imageName = time(). '.' .$exe;
      $image->move(public_path('uploads/books'),$imageName);
      $book->image = $imageName;
      $book->save();
      return redirect()->route('books.index')->with('success','Book added successfully');
    }

    public function edit($id){
       $book = Book::findOrFail($id);
      return view('books.edit',[
        'book' => $book
      ]);
    }

    public function update ($id , Request $request){
       $book = Book::findOrFail($id);
      $rule = [
        'title' => 'required',
        'author' => 'required',
        'status' => 'required'
      ];
      $validator = Validator::make($request->all(),$rule);

      if($validator->fails()){
        return redirect()->route('books.edit', $book->id)->withInput()->withErrors($validator);
      }
      
      if(!empty($request->image)){
        $rule['image'] = 'image';
      }

      $book->title = $request->title;
      $book->author = $request->author;
      $book->desc = $request->desc;
      $book->status = $request->status;
      if(!empty($request->image)){
      $image = $request->image;
      $exe = $image->getClientOriginalExtension();
      $imageName = time(). '.' .$exe;
      $image->move(public_path('uploads/books'),$imageName);
      $book->image = $imageName;
      }
      $book->save();
      return redirect()->route('books.index')->with('success','Book Updated successfully');
    }

      public function destroy(Request $request){
          $book = Book::find($request->id);
          if ($book == null) {
              return response()->json([
                  'status' => false,
                  'message' => 'Book not found'
              ]);
          } else {
              $imagePath = public_path('uploads/books/' . $book->image);

              if (!empty($book->image) && File::exists($imagePath)) {
                  File::delete($imagePath);
              }
              $book->delete();
              return response()->json([
                  'status' => true,
                  'message' => 'Book deleted Successfully'
              ]);
          }
      }
      
}
