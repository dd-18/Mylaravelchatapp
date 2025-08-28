<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|',
                'user_id' => 'required',
                'other_user_id' => 'required'
            ]);

            // Get the uploaded file
            $image = $request->file('image');
            
            // Unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            // Create chat_images directory if it doesn't exist
            if (!file_exists(public_path('storage/chat_images'))) {
                mkdir(public_path('storage/chat_images'), 0755, true);
            }
            
            // Store the image in public/storage/chat_images
            $path = $image->storeAs('chat_images', $filename, 'public');
            
            // Generate full URL for the image
            $imageUrl = asset('storage/' . $path);
            
            return response()->json([
                'success' => true,
                'image_url' => $imageUrl,
                'message' => 'Image uploaded successfully'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
}