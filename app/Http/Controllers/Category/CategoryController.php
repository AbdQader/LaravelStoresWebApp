<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    /** to view the craete category page */
    public function create ()
    {
        return view('admin.category.create');
    }

    /** to store a new category in the database */
    public function store (Request $request)
    {
        $name = $request['name'];
        $image = $request->file('image');

        $image_name = time() . rand(1, 1000000000);
        $ext = $image->getClientOriginalExtension();
        $path = "images/categories/$image_name.$ext";

        Storage::disk('local')->put($path, file_get_contents($image));

        // create new category
        $category = new Category();
        $category->name = $name;
        $category->image = $path;
        $result = $category->save();

        return redirect()->back()->with('status', $result);
    }

    /** to get all categories for the admin */
    public function index_admin ()
    {
        $categories = $this->get_categories();
        return view('admin.category.index')->with('categories', $categories);
    }

    /** to get all categories for the user */
    public function index_user ()
    {
        $categories = $this->get_categories();
        return view('user.category.index')->with('categories', $categories);
    }

    private function get_categories ()
    {
        $categories = Category::orderBy('categories.created_at', 'DESC')->get();
        foreach ($categories as $category)
        {
            $image_link = Storage::url($category->image);
            $category->image = $image_link;
        }
        return $categories;
    }

    /** to get the category we want to edit it */
    public function edit ($id)
    {
        $category = Category::find($id);
        $image_link = Storage::url($category->image);
        $category->image = $image_link;

        return view('admin.category.edit')->with('category', $category);
    }
    
    /** to update the category */
    public function update (Request $request, $id)
    {
        $name = $request['name'];
        $image = $request->file('image');

        $image_name = time() . rand(1, 1000000000);
        $ext = $image->getClientOriginalExtension();
        $path = "images/categories/$image_name.$ext";

        Storage::disk('local')->put($path, file_get_contents($image));

        $category = Category::find($id);
        $category->name = $name;
        $category->image = $path;
        $result = $category->save();

        return redirect()->back()->with('status', $result);
    }

    /** to delete the category */
    public function destroy ($id)
    {
        $category = Category::find($id);
        $result = $category->delete();

        return redirect()->back()->with('status', $result);
    }
    
}
