<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\StoreBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Http\CPU\FileHelpers;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.Banners.index', compact('banners'));
    }

    public function create()
    {
        return response()->json([
            'success' => true
        ]);
    }

    public function store(StoreBannerRequest $request)
    {

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = FileHelpers::handleImage($request->image, 'banners/');
                if ($imagePath === null) {
                    return response()->json([
                        'success' => false,
                        'message' => trans('messages.Failed to upload image')
                    ], 422);
                }
                $data['image'] = $imagePath;
            }

            $data['status'] = 1; // Default active status

            Banner::create($data);

            return response()->json([
                'success' => true,
                'message' => trans('messages.Banner created successfully')
            ]);
        } catch (\Exception $e) {
            Log::error('Banner creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => trans('messages.Something went wrong')
            ], 500);
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return response()->json([
            'success' => true,
            'banner' => $banner
        ]);
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old image first
                if ($banner->image) {
                    FileHelpers::deleteImage($banner->image);
                }

                // Upload new image
                $imagePath = FileHelpers::handleImage($request->image, 'banners/');
                if ($imagePath === null) {
                    return response()->json([
                        'success' => false,
                        'message' => trans('messages.Failed to upload image')
                    ], 422);
                }
                $data['image'] = $imagePath;
            }

            $banner->update($data);

            return response()->json([
                'success' => true,
                'message' => trans('messages.Banner updated successfully')
            ]);
        } catch (\Exception $e) {
            Log::error('Banner update failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => trans('messages.Something went wrong')
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);

            // Delete image if exists
            if ($banner->image) {
                FileHelpers::deleteImage($banner->image);
            }

            $banner->delete();

            return response()->json([
                'success' => true,
                'message' => trans('messages.Banner deleted successfully')
            ]);
        } catch (\Exception $e) {
            Log::error('Banner deletion failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => trans('messages.Something went wrong')
            ], 500);
        }
    }

    public function changeStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();

        return response()->json([
            'success' => true,
            'message' => trans('messages.Status updated successfully')
        ]);
    }
}
