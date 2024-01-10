@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
<script>
    @include('flash::message')
</script>

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-center">All Categories</h2>
        </div>

        @if(count($categorys) > 0)
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th style="background-color: black;color:white;">ID</th>
                        <th style="background-color: black;color:white;">Image</th>
                        <th style="background-color: black;color:white;">Category Name</th>
                        <th style="background-color: black;color:white;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorys as $category)
                        <tr style="background-color: red">
                            <td class="text-center">{{ $category->id }}</td>
                            <td class="text-center">
                                <img src="{{ asset('uploads/' . $category->image) }}" alt="Category Image" style="max-height: 60px; max-width: 120px;">
                            </td>
                            <td class="text-center" style="font-weight: bold">{{ $category->categorie_name }}</td>
                            <td>
                                <a href="#" class="btn btn-sm" title="Update" data-bs-toggle="modal" data-bs-target="#updateModal{{ $category->id }}">
                                    <img src="{{ asset('update.png') }}" alt="Update Category" style="max-height: 50;max-width: 60;">
                                </a>

                                <!-- Modal for Update Form -->
                                <div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="updateForm{{ $category->id }}" action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="update_category_name{{ $category->id }}" class="form-label">Updated Category Name:</label>
                                                        <input type="text" class="form-control" id="update_category_name{{ $category->id }}" name="categorie_name" value="{{ $category->categorie_name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="update_image{{ $category->id }}" class="form-label">Updated Category Image:</label>
                                                        <input type="file" class="form-control" id="update_image{{ $category->id }}" name="image">
                                                    </div>

                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary" onclick="submitUpdateForm('{{ $category->id }}')">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center">
                <p>No categories found</p>
                <img src="{{ asset('notfound.png') }}" alt="No Data Image" style="max-height: 200;max-width: 200;">
            </div>
        @endif
    </div>

    <script>
        function submitUpdateForm(categoryId) {
            var form = document.getElementById('updateForm' + categoryId);
            var formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                if (data.includes("success")) {
                    // Display success toast
                    Toast.fire({
                        icon: 'success',
                        title: 'Category updated successfully'
                    });

                    // Reload the page after a short delay
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    // Display error toast
                    Toast.fire({
                        icon: 'error',
                        title: data
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
@endsection
