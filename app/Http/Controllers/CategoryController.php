<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(16);
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
            'priority'=>'required|numeric|min:1|unique:categories,priority',
            'picture' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        // check if a picture was uploaded
        if ($request->hasFile('picture')) {
            // Generate a unique file name based on the current timestamp and the file extension
        $fileName = time() . '.' . $request->picture->extension();

        // Move the uploaded file to the public/uploads/categories directory
        $request->picture->move(public_path('uploads/categories'), $fileName);

        // Add the file name to the validated data array
        $data['picture'] = $fileName;
        }

        //create a new category with the validated data
        Category::create($data);
        
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
