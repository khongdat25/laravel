<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh mục - Admin | Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/admin/sidebar.css')
    @vite('resources/css/admin/category.css')

</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <div class="main-content">
        <div class="form-card">
            <h2><i class="fas fa-edit"></i> Sửa Danh mục</h2>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên danh mục <span style="color:red;">*</span></label>
                    <input type="text" name="name" placeholder="Ví dụ: Laptop Gaming" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" placeholder="laptop-gaming" value="{{ old('slug', $category->slug) }}">
                    <small style="color:#666;">Để trống sẽ tự tạo từ tên danh mục</small>
                    @error('slug')
                        <br><small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" rows="4" placeholder="Mô tả ngắn về danh mục này...">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select name="parent_id">
                        <option value="">Không có (Danh mục chính)</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                    <button type="button" class="btn-cancel" onclick="history.back()">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
