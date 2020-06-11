<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\BookResource;
use App\Helper\Functions\BookTrait;
use App\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{

  use BookTrait;

    public function external(Request $request) {
        $query = $request->get('name');
        $url = 'https://www.anapioficeandfire.com/api/books?name=' . $query;
        $response = Http::get($url)->json();
        $formattedBook = $this->formattedExternal($response);

        return $this->apiResponse(200, 'success', $formattedBook);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $books = Book::latest()->get();
    //    dd($books);
       if($books) {
        $resourced = BookResource::collection($books);
        return $this->apiResponse(200, 'success', $resourced);
       }

       return $this->apiResponse(200, 'success', []);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $validatedRequest = $request->validated();
        
        $book = Book::createIfNotExist($validatedRequest);

        $formattedBook = $this->formatted($book);

        return $this->apiResponse(201, 'success', $formattedBook);
        
       
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        $formattedBook = $this->formatted($book);

        return $this->apiResponse(200, 'success', $formattedBook);    

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $validatedRequest = $request->all();
        if($book) {
            if($book->update($validatedRequest)) {
                $formatted = $this->formatted($book);
                $message = "The book " . $formatted->name . ' was updated successfully';
                return $this->apiResponseWithMessage(200, 'success', $message , $formatted);
            }
        }

        return $this->apiResponseWithMessage(404, 'fail', 'No query results for model', []);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $message = 'The book ' . $book->name . ' was deleted successfully';
        $book->delete();
        return $this->apiResponseWithMessage(204, 'success', $message, []);
    }
}
