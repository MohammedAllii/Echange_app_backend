@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: black;color:white;">{{ __('Create Category') }}</div>

                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('categ.png') }}" alt="Category Image" class="img-fluid" style="max-height: 150px;">
                        </div>

                        <form id="createCategoryForm" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="categorie_name">Category Name:</label>
                                <input type="text" class="form-control" id="categorie_name" name="categorie_name">
                            </div>

                            <div class="form-group">
                                <label for="image">Category Image:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <button type="button" style="background-color: black;color:white;margin-left:280px;" class="btn btn-block mt-4" onclick="validateForm()" style="background-color:bisque;font-weight: bold;">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var categoryName = document.getElementById('categorie_name').value;
            var imageInput = document.getElementById('image');
    
            if (categoryName.trim() === '' && !imageInput.files.length) {
                // Both category name and image are empty
                showToast('Error: Please enter a category name and select an image.');
            } else if (categoryName.trim() === '') {
                // Category name is empty
                showToast('Error: Please enter a category name.');
            } else if (!imageInput.files.length) {
                // Image is not selected
                showToast('Error: Please select an image.');
            } else {
                // Submit the form asynchronously
                submitForm();
            }
        }
    
        function showToast(message, isError = true) {
            var toast = new bootstrap.Toast(document.getElementById('errorToast'));
            var toastHeader = document.querySelector('.toast-header');
    
            if (isError) {
                toastHeader.classList.remove('bg-success');
                toastHeader.classList.add('bg-danger');
            } else {
                toastHeader.classList.remove('bg-danger');
                toastHeader.classList.add('bg-success');
            }
    
            document.getElementById('toastMessage').innerText = message;
            toast.show();
        }
    
        function submitForm() {
            var form = document.getElementById('createCategoryForm');
            var formData = new FormData(form);
    
            fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display success toast
                    showToast(data.message, false);
                    // Reload the page after a short delay (adjust as needed)
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    // Display error toast
                    showToast('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An unexpected error occurred.');
            });
        }
    </script>
    

    <!-- Toast HTML -->
    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto">Error</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage">
            <!-- Error message will be displayed here -->
        </div>
    </div>
@endsection
