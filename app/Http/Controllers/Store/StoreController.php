<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Store;
use App\Models\Rating;

class StoreController extends Controller
{
    /** to get all the stores as pagination */
    public function index ()
    {
        $stores = Store::orderBy('stores.created_at', 'DESC')->paginate(3);
        foreach ($stores as $store)
        {
            $image_link = Storage::url($store->image);
            $store->image = $image_link;
        }
        
        return view('admin.index')->with('stores', $stores);
    }

    /** to view the craete store page */
    public function create ()
    {
        $categories = Category::all();
        return view('admin.store.create')->with('categories', $categories);
    }

    /** to store a new store in the database */
    public function store (Request $request)
    {
        $name = $request['name'];
        $address = $request['address'];
        $phone = $request['phone'];
        $category_id = $request['category_id'];
        $image = $request->file('image');

        $image_name = time() . rand(1, 1000000000);
        $ext = $image->getClientOriginalExtension();
        $path = "images/stores/$image_name.$ext";

        Storage::disk('local')->put($path, file_get_contents($image));

        // create new store
        $store = new Store();
        $store->name = $name;
        $store->address = $address;
        $store->phone = $phone;
        $store->category_id = $category_id;
        $store->image = $path;
        $result = $store->save();

        return redirect()->back()->with('status', $result);
    }

    /** to get all stores for the admin */
    public function index_admin ()
    {
        $stores = Store::with('category')->orderBy('stores.created_at', 'DESC')->get();
        foreach ($stores as $store)
        {
            $image_link = Storage::url($store->image);
            $store->image = $image_link;
        }
        
        return view('admin.store.index')->with('stores', $stores);
    }

    /** to get a specific category stores for the user */
    public function index_user ($id)
    {
        $stores = Store::where('category_id', $id)->orderBy('stores.created_at', 'DESC')->get();    
        foreach ($stores as $store)
        {
            $image_link = Storage::url($store->image);
            $store->image = $image_link;
        }

        return view('user.store.index')->with('stores', $stores);
    }

    /** to get a specific store details */
    public function store_details (Request $request, $id)
    {
        $ip = $request->ip(); // to get the user IP
        $store = Store::where('id', $id)->with('category')->first();
        $image_link = Storage::url($store->image);
        $store->image = $image_link;

        // to get the user rating for this store
        $rating = Rating::where('store_id', $store->id)->where('user_ip', $ip)->first();
        if ($rating != null)
        {
            $user_rating = $rating->rating;
        } else
        {
            $user_rating = null;
        }

        // to get the store ratings average in this week
        $trending = Rating::where('store_id', $store->id)
            ->where(DB::raw('week(created_at)'), DB::raw('week(now())'))
            ->avg('rating');

        return view('user.store.details')->with('store', $store)
            ->with('user_rating', $user_rating)->with('trending', $trending);
    }

    /** to search for stores by store name, for the admin */
    public function search_admin(Request $request)
    {
        $keyword = $request['search'];
        $stores = Store::where('name', 'LIKE', '%'.$keyword.'%')->with('category')->get();
        foreach ($stores as $store)
        {
            $image_link = Storage::url($store->image);
            $store->image = $image_link;
        }

        return view('admin.store.search')->with('stores', $stores)->with('search', $keyword);
    }

    /** to search for stores by store name, for the user */
    public function search_user (Request $request)
    {
        $keyword = $request['search'];
        $stores = Store::where('name', 'LIKE', '%'.$keyword.'%')->get();
        foreach ($stores as $store)
        {
            $image_link = Storage::url($store->image);
            $store->image = $image_link;
        }

        return view('user.store.search')->with('stores', $stores)->with('search', $keyword);
    }

    /** to get the store we want to edit it */
    public function edit ($id)
    {
        $store = Store::find($id);
        $image_link = Storage::url($store->image);
        $store->image = $image_link;

        $categories = Category::all();

        return view('admin.store.edit')->with('store', $store)->with('categories', $categories);
    }

    /** to update the store */
    public function update (Request $request, $id)
    {
        $name = $request['name'];
        $address = $request['address'];
        $phone = $request['phone'];
        $category_id = $request['category_id'];
        $image = $request->file('image');

        $image_name = time() . rand(1, 1000000000);
        $ext = $image->getClientOriginalExtension();
        $path = "images/stores/$image_name.$ext";

        Storage::disk('local')->put($path, file_get_contents($image));
        
        $store = Store::find($id);
        $store->name = $name;
        $store->address = $address;
        $store->phone = $phone;
        $store->category_id = $category_id;
        $store->image = $path;
        $result = $store->save();

        return redirect()->back()->with('status', $result);
    }

    /** to delete the store */
    public function destroy ($id)
    {
        $store = Store::find($id);
        $result = $store->delete();
        return redirect()->back()->with('status', $result);
    }
    
}
