<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\helpers\DefaultImageHelper;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\CPU\FileHelpers;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.Categories.index', compact('categories'));
    }
    public function create()
    {
        $sections = Section::where('status', 1)->get();
        $parentCategories = Category::where('status', 1)->whereNull('parent_id')->get();
        return response()->json([
            'sections' => $sections,
            'parentCategories' => $parentCategories
        ]);
    }
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name_en']);
        $data['status'] = $data['status'] ? 1 : 0;
        $data['image'] = null; // Initialize image as null

        // @phpstan-ignore-next-line
        if ($request->hasFile('image')) {
            // @phpstan-ignore-next-line
            $image = $request->image;
            $imagePath = FileHelpers::handleImage($image, 'categories/');
            if ($imagePath) {
                $data['image'] = $imagePath;
            }
        }

        $category = Category::create([
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'slug' => $data['slug'],
            'image' => $data['image'],
            'description_ar' => $data['description_ar'],
            'description_en' => $data['description_en'],
            'section_id' => $data['section_id'],
            'parent_id' => $data['parent_id'],
            'point' => $data['point'],
            'status' => $data['status']
        ]);

        return response()->json([
            'success' => true,
            'message' => trans('messages.Category created successfully'),
            'category' => $category
        ]);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $sections = Section::where('status', 1)->get();
        $parentCategories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        return response()->json([
            'category' => $category,
            'sections' => $sections,
            'parentCategories' => $parentCategories
        ]);
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();

        $slug = Str::slug($data['name_en'] ?? $category->name_en);
        $image = $category->image; // Keep existing image by default

        // @phpstan-ignore-next-line
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                FileHelpers::deleteImage($category->image);
            }

            // @phpstan-ignore-next-line
            $imageFile = $request->image;
            $imagePath = FileHelpers::handleImage($imageFile, 'categories/');
            if ($imagePath) {
                $image = $imagePath;
            }
        }

        $category->name_ar = $data['name_ar'] ?? $category->name_ar;
        $category->name_en = $data['name_en'] ?? $category->name_en;
        $category->slug = $slug;
        $category->image = $image;
        $category->description_ar = $data['description_ar'] ?? $category->description_ar;
        $category->description_en = $data['description_en'] ?? $category->description_en;
        $category->section_id = $data['section_id'] ?? $category->section_id;
        $category->parent_id = $data['parent_id'] ?? $category->parent_id;
        $category->point = $data['point'] ?? $category->point;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => trans('messages.Category updated successfully'),
            'category' => $category
        ]);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check if category has products
        if ($category->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.Cannot delete category with products')
            ], 400);
        }

        // Check if category has subcategories
        Category::where('parent_id', $id)->update(['parent_id' => null]);

        // Delete image
        if ($category->image) {
            FileHelpers::deleteImage($category->image);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => trans('messages.Category deleted successfully')
        ]);
    }

    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => trans('messages.Status updated successfully'),
            'status' => $category->status
        ]);
    }
}
