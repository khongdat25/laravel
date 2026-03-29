<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh mục - Admin | Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/admin/sidebar.css')
    @vite('resources/css/admin/category.css')

</head>
<body>

<div class="admin-container">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h2><i class="fas fa-tags"></i> Quản lý Danh mục</h2>
            <button class="btn-add" onclick="window.location.href='{{ route('admin.categories.create') }}'">
                <i class="fas fa-plus"></i> Thêm danh mục mới
            </button>
        </div>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th width="120">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ $category->slug }}</td>
                        <td><em>{{ $category->description ? \Illuminate\Support\Str::limit($category->description, 50) : 'Không có' }}</em></td>
                        <td>
                            <button class="action-btn btn-edit" title="Sửa" onclick="window.location.href='{{ route('admin.categories.edit', $category->id) }}'"><i class="fas fa-edit"></i></button>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa danh mục \'{{ addslashes($category->name) }}\' không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Chưa có danh mục nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
