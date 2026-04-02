<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ]);
            return response()->json(['success' => true, 'message' => 'Added to wishlist!']);
        }

        return response()->json(['success' => false, 'message' => 'Already in wishlist!']);
    }

    public function remove($id)
    {
        try {
            $wishlist = Wishlist::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $wishlist->delete();

            return response()->json(['success' => true, 'message' => 'Removed from wishlist!']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing item: ' . $e->getMessage()]);
        }
    }
}