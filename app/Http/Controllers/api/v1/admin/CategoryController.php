<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\AllCategoryResource;
use App\Http\Resources\Category\OneCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $category=Category::where('category_id',null)->paginate($request->input('limit'));
        return response([
            'message'=>"all categories",
            'data'=>AllCategoryResource::collection($category),
            'total'=>$category->total()
        ]);
    }

 
    public function store(StoreCategoryRequest $request)
    {
        $category=Category::create($request->validated());
        return response([
            'message'=>"created category",
            'data'=>new OneCategoryResource($category)
        ], 201);
    }

    
    public function show($id,Request $request)
    {
        $category=Category::find($id);

        if (isset($category)) {
            $books = $category->books();
            if ($filter = $request->input('filter')) {

                if ($filter == "cheap") {
                    $books->orderBy('price', 'asc');
                }elseif($filter == "expensive") {
                    $books->orderBy('price', 'desc');
                }elseif($filter == "rating"){
                    $books->orderBy('rating', 'desc');
                }elseif($filter == "recentlyAdded"){
                    $books->orderBy('id','desc');
                }elseif($filter == "moreSeen"){
                    $books->orderBy('click','desc');
                }
            }
            $count=$books->count();
            // $category->setRelation(
            //     'books',
            //     $books->orderBy('id')->paginate($request->input('limit'))
            // );
            $category->setRelation(
                'books',
                $books->orderBy('id')->paginate($request->input('limit'))
            );
            $category['books_total'] = $count;
            return response([
                    'message' => 'one category',
                    'data' => new OneCategoryResource($category)
                ]);
        }
        else {
            return response([
                'message'=>'id not found'
            ],404);
        }
    }

  
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category=Category::find($id);
        if ($category) {
            $category->update($request->validated());
            $category=Category::find($id);
            return response([
                'message'=>'category updated succsesfull',
                'data'=>new OneCategoryResource($category)
            ]);
        } else {
            return response([
               'message'=>'id not found'
            ],404);
        }
        
    }

    
    public function destroy($id)
    {
        $category=Category::find($id);
        if($category)
        {
            $category->delete();
            return response([
               'message'=>'category deleted'
            ]);
        }
        else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }
}
