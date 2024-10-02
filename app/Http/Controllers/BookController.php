<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use DB;
use Illuminate\Support\Facades\View;

class BookController extends Controller
{
     public function booklist(Request $request)
    {
        $search = $request->input('search');
        $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('author', 'like', "%{$search}%");
        })->get();
        return view('user.booklist', compact('books'));
    }
    public function Addbook()
    {
        return view('user.addbook');

    }
    public function Insertbook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string',
            'published_date' => 'required|date',
            
        ], 
        [
            'title.required' => 'Please enter your  title name.',
            'author.required' => 'Please enter a author name.',
            'published_date.required' => 'Please enter a published date.',
            
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(['status' => 422, 'errors' => $errors]);
        }
        $Book = new Book();
        $Book->title = $request->title;
        $Book->description = $request->description;
        $Book->author = $request->author;
        $Book->published_date = $request->published_date;
        $Book->save();
        if ($Book) {
            return response()->json(['status' => 200, 'msg' => 'Submit successful']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Something went wrong!']);
        }

    }
    public function Editbook(Request $request)
    {
        $ids = $request->query('ids');
        $edit_dt = Book::findOrFail($ids);
        return view('user.editbook', compact('edit_dt'));
    }
    
        public function Updatebook(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string',
            'published_date' => 'required|date',
            
        ], 
        [
            'title.required' => 'Please enter your  title name.',
            'author.required' => 'Please enter a author name.',
            'published_date.required' => 'Please enter a published date.',
            
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json(['status' => 422, 'errors' => $errors]);
        }
        $mainid = $request->mainid;
        $bookdata = Book::find($mainid);
            if($bookdata)
            {
                $bookdata->title = $request->title;
                $bookdata->description = $request->description;
                $bookdata->author = $request->author;
                $bookdata->published_date = $request->published_date;
                $bookdata->save();
                if ($bookdata) {
                return response()->json(['status' => 200, 'msg' => 'Updated successful']);
                } else {
                return response()->json(['status' => 500, 'msg' => 'Something went wrong!']);
                }

            }
            else
            {
            print_r("not");die();
            }
    }
    public function Deletebook($id)
    {
        $data = Book::where('id', $id)
        ->delete();
        if ($data) {
        return response()->json(['status' => 200, 'msg' => 'Book Deleted']);
        } else {
        return response()->json(['status' => 500, 'msg' => 'Something went wrong!']);
        }
    }
    public function bookshow(Request $request)
    {
         $bid = $request->bid;
         $bookData = DB::table('books')
                ->where('id', $bid)
                ->first();
        $modalContenthp = View::make('pop_up.bookshow')->with(compact('bookData'))->render();
        return response()->json($modalContenthp);
       
       
     }
     
        
}
