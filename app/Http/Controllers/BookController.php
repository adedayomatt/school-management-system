<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderby('created_at','desc')->get();
        return view('book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => ['required'],
            'author' => ['required'],
            'classroom' => ['required'],
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'classroom_id' => $request->class,
        ]);

        return redirect()->route('book.index')->with('success', 'New book '.$book->title.'');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('book.show')->with('book',Book::findorfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('book.edit')->with('book',Book::findorfail($id));
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
        $this->validate($request,[
            'title' => ['required'],
            'author' => ['required'],
            'classroom' => ['required'],
        ]);

        $book = Book::findorfail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->classroom_id = $request->classroom;
        $book->save();

        return redirect()->route('book.show',[$book->id])->with('success',$book->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findorfail($id);
        $book->delete();
        
        return redirect()->route('book.index')->with('success', $book->title.' deleted');

    }
}
