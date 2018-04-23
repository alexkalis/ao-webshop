<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Products;
use DB;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    $categories = Categories::paginate(10);
    return view('categories.index')->with('categories', $categories);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
      // $category_name = DB::table('categories')->select('id', $id)->get();
      $category = Categories::find($id);
      $products = $category->product;
      // $cat_prd = Categories::all()->load('product');
      // , 'category' => $category_name
      return view('categories.show', ['products' => $products]);
    }
}
