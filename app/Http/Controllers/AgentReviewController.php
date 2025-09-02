<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\Business;
class AgentReviewController extends Controller
{
    public function reviews($business_id, $link)
    {
        $review = ProductReview::where([
            'business_id'=> $business_id, 
            'status'=>'awaiting',
            'link'=> $link
        ])->first();
        if (!$review) {
            abort(404);
        }
        return view('review.index', compact('business_id'));
    }

    public function storeReview(Request $request, $business_id)
    { 
        $review = ProductReview::where([
            'business_id'=> $business_id, 
            'status'=>'awaiting'
        ])->first();

        if (!$review) {
            abort(404);
        }
        $review->update([
            'reviews' => $request->review,
            'status' => 'completed'
        ]);
        $business = Business::with('owner')->find($business_id);
        if ($business) {
            $business->owner->update([
                'rating' => $request->rating
            ]);
            $request->session()->forget('review_alert_link');
            $request->session()->forget('review_alert');
        }
        return view('review.response');
    }
}
