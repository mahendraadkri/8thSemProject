<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
         //dd($request->name); it print the single data..
        $data = $request->validate([
            'name'=> 'required|string|max:255|unique:categories',
            'priority'=>'required|numeric|min:1|unique:categories,priority'
        ]);
        //dd($data); print data
        Category::create($data);
        return redirect(route('category.index'))->with('success','Category created successfully!');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'priority' => 'required|numeric'
        ]);

        $category = Category::find($id);
        $category->update($data);
        return redirect(route('category.index'));
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect(route('category.index'));
    }
}
