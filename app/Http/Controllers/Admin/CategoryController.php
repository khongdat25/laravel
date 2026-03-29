<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation: Kiểm tra dữ liệu
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'nullable|unique:categories|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục này đã tồn tại',
            'slug.unique' => 'Slug này đã tồn tại',
            'parent_id.exists' => 'Danh mục cha không hợp lệ',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // Lưu vào database
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get(); // Ngăn chọn chính nó làm thư mục cha
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|max:255|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục này đã tồn tại',
            'slug.unique' => 'Slug này đã tồn tại',
            'parent_id.exists' => 'Danh mục cha không hợp lệ',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công!'); 
    }
}
