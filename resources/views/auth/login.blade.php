@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: black;color:white;font-weight:bold">{{ __('Login Admin') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Add your image here -->
                                <img src="{{ asset('logged.png') }}" alt="Your Image" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                @if(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('success'))
                                    <!-- Display success message using Swal toast -->
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: '{{ session('success') }}',
                                            showConfirmButton: false,
                                            timer: 3000 // 3 seconds
                                        }).then(() => {
                                            // Reload the page after a short delay
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000); // 1000 milliseconds = 1 second
                                        });
                                    </script>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn" style="background-color: black; color: white; font-weight: bold; margin-left: 90px; width: 170px">
                                        <img src="{{ asset('login.png') }}" alt="Login Icon" style="width:20px; margin-right: 10px;">
                                        {{ __('Login') }}
                                    </button>
                                                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Swal script for success message -->
   <!-- Toastr script to show success and error messages -->
<!-- Toastr script to show success and error messages -->
<script>
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

    @if(session('success'))
        // Display success toast
        showToast("{{ session('success') }}", false);
        // Reload the page after a short delay (adjust as needed)
        setTimeout(function() {
            window.location.reload();
        }, 2000);
    @endif
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
