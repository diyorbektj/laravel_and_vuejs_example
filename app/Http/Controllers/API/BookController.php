<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    // all books
    public function index(Request $request)
    {
        $books = Book::all();
        return BookResource::collection($books);
    }
    // add book
    public function add(Request $request)
    {
        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->user_id = auth()->user()->id;
        $book->save();
        $name = $book->name;
        $author = $book->author;
        $created_at = $book->created_at;

        return response()->json([
           "data"=> 
           [
                "id" => $book->id,
                "name"=>$name,
                "author"=>$author,
                "created_at"=>$created_at
        ],
        "message" =>'The book successfully added',
        "status" => 1
        ]);
    }

    // edit book
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json('The book successfully updated');
    }

    // delete book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }
    public function getBooks(Request $request)
    {
        $data = Book::where('name', 'LIKE','%'.$request->keyword.'%')->get();
        return response()->json($data); 
    }
}
