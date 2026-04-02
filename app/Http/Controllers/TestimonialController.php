<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('approved', true)
            ->latest()
            ->take(10)
            ->get();
        
        return response()->json($testimonials);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'message' => 'required|string|min:10',
            'rating' => 'integer|min:1|max:5'
        ]);

        $testimonial = Testimonial::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating ?? 5,
            'approved' => true, 
            'avatar' => $this->getRandomAvatar()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback!',
            'testimonial' => $testimonial
        ]);
    }

    private function getRandomAvatar()
    {
        $avatars = [
            'https://i.pravatar.cc/100?u=' . rand(1, 100),
            'https://randomuser.me/api/portraits/women/' . rand(1, 99) . '.jpg',
            'https://randomuser.me/api/portraits/men/' . rand(1, 99) . '.jpg',
        ];
        return $avatars[array_rand($avatars)];
    }
}