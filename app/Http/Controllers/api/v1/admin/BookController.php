<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\OneBookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $book=Book::paginate($r->input('limit'));
        return response([
            'message'=>"all books",
            'data'=>OneBookResource::collection($book)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book=Book::create($request->validated());
        $word=Book::find($book->id);
        $word->categories()->sync([$request['categories_id']]);
        return response([
            'message'=>"created book",
            'data'=>new OneBookResource($book)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::find($id);
        if(isset($book))
        {
            return response([
                'message'=>'one category',
                'data'=>new OneBookResource($book)
            ]);
        }
        else {
            return response([
                'message'=>'id not found'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book=Book::find($id);
        if ($book) {
            $category_update=$book->update($request->validated());
            $book=Book::find($id);
            return response([
                'message'=>'category updated succsesfull',
                'data'=>new OneBookResource($book)
            ]);
        } else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
