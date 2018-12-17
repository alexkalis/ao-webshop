<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;
use Auth;

class ReviewController extends Controller {

    public function createReview(Request $request) {
        $review = new Review();
        $user = Auth::user();
        // dd( $request->input('name'));
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'review' => 'required',
        ]);
        $review->user_id = $user->id;
        $review->product_id = $request->input('product');
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->review = $request->input('review');
        $review->save();
        return redirect()->back();
    }
}
