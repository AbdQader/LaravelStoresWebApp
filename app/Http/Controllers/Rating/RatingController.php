<?php

namespace App\Http\Controllers\Rating;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;
use App\Models\Store;

class RatingController extends Controller
{
    /** to store the user rating in the database */
    public function store (Request $request, $id)
    {
        $rating_value = $request['rating'];
        $ip = $request->ip();  // to get the client ip address
        //$mac = exec('getmac'); // to get the client mac address
        
        // check if the user rate the store before or not
        $ratings = Rating::all();
        if (count($ratings) > 0)
        {
            foreach ($ratings as $rating)
            {
                if ($rating->store_id == $id && $rating->user_ip == $ip)
                {
                    $result = $this->update($rating_value, $rating->id);
                    return redirect()->back()->with('status', $result);
                }
            }
        }

        // store the rating in the database
        $rating = new Rating();
        $rating->rating = $rating_value;
        $rating->store_id = $id;
        $rating->user_ip = $ip;
        $status = $rating->save();

        // check if the rating saved or not
        if ($status)
        {
            // calculate the ratings average
            $rating_avg = Rating::where('store_id', $id)
                ->select(DB::raw('SUM(rating) / COUNT(user_ip) AS avg_rating'))
                ->first()->avg_rating;
            
            // update the store ratings count & ratings average
            $store = Store::find($id);
            $store->ratings_count += 1;
            $store->ratings_average = $rating_avg;
            $result = $store->save();
        }

        return redirect()->back()->with('status', $result);
    }

    /** to update the user rating */
    private function update ($rating_value, $id)
    {
        // store the rating in the database
        $rating = Rating::find($id);
        $rating->rating = $rating_value;
        $status = $rating->save();

        if ($status)
        {
            // calculate the rating average
            $rating_avg = Rating::where('store_id', $rating->store_id)
                ->select(DB::raw('SUM(rating) / COUNT(user_ip) AS avg_rating'))
                ->first()->avg_rating;
            
            // update the store ratings count & ratings average
            $store = Store::find($rating->store_id);
            $store->ratings_average = $rating_avg;
            $result = $store->save();
        }
        return $result;
    }

}
