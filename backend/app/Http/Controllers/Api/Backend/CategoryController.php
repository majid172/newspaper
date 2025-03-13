<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;  // This is the correct Request class
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $lists = Category::paginate(10);
        $categories = Category::all();
        return response()->json([
            'lists' => $lists,
            'categories' => $categories
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'parent_category' => 'nullable|exists:categories,id', //Fixed for parent_category
//            'header_display' => 'boolean',
//            'menubar_display' => 'boolean',
//            'status' => 'boolean',
            // 'keyword' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $category = new Category();
            $category->category_name = $validatedData['category_name'];

            $category->title = $validatedData['title'];
            $category->parent_id = $validatedData['parent_category'] ?: null; //Fixed for parent_category
            $category->header_display = $validatedData['header_display'] ?? false;
            $category->menubar_display = $validatedData['menubar_display'] ?? false;
            $category->status = $validatedData['status'] ?? false;
            // $category->keyword = $validatedData['keyword'];
            $category->slug = Str::slug($category->title);

            $originalSlug = $category->slug;
            $count = 1;
            while (Category::where('slug', $category->slug)->exists()) {
                $category->slug = $originalSlug . '-' . $count++;
            }

            $category->save();

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Category created successfully']);
//            return redirect()->route('categories.index')
//                ->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error storing category: ' . $e->getMessage(), [
                'request' => $request->all(),
            ]);

            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later.', 'error' => $e->getMessage()], 500); // Changed for API
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'parent_category' => 'nullable|exists:categories,id', //Fixed for parent_category
            'header_display' => 'boolean',
            'menubar_display' => 'boolean',
            'status' => 'boolean',
            // 'keyword' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $category->category_name = $validatedData['category_name'];
            $category->title = $validatedData['title'];
            $category->parent_id = $validatedData['parent_category'] ?: null; //Fixed for parent_category
            $category->header_display = $validatedData['header_display'] ?? false;
            $category->menubar_display = $validatedData['menubar_display'] ?? false;
            $category->status = $validatedData['status'] ?? false;
            // $category->keyword = $validatedData['keyword'];


            if ($category->isDirty('title')) {
                $category->slug = Str::slug($category->title);
                $originalSlug = $category->slug;
                $count = 1;
                while (Category::where('slug', $category->slug)->where('id', '!=', $category->id)->exists()) {
                    $category->slug = $originalSlug . '-' . $count++;
                }
            }

            $category->save();

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Category updated successfully']);  //Changed for api
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating category: ' . $e->getMessage(), [
                'request' => $request->all(),
            ]);

            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later.', 'error' => $e->getMessage()], 500);  //Changed for api
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->delete();

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);  //Changed for api
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting category: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again later.', 'error' => $e->getMessage()], 500);  //Changed for api
        }
    }

}
