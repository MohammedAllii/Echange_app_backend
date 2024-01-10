@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add these lines to your layout or view file -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

@section('content')
    <div class="container">
        <!-- Image with height 100 -->
<img src="{{ asset('safe.png') }}" alt="Your Image Description" height="100">

<div class="d-flex justify-content-between align-items-center">
    <h2 class="text-center">All Users (Not Banned)</h2>

    <!-- Switcher to Redirect to "/notban" route -->
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="notBanSwitch">
        <label class="form-check-label" for="notBanSwitch">Show Banned users</label>
    </div>
</div>


        @if(count($users) > 0)
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th style="background-color: black;color:white;">ID</th>
                    <th style="background-color: black;color:white;">Name</th>
                    <th style="background-color: black;color:white;">Email</th>
                    <th style="background-color: black;color:white;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr style="background-color: red">
                            <td class="text-center"  style="background-color: rgb(223, 245, 153);font-weight: bold;">{{ $user->id }}</td>
                            <td class="text-center"  style="background-color: rgb(223, 245, 153);font-weight: bold;">{{ $user->name }}</td>
                            <td class="text-center"  style="background-color: rgb(223, 245, 153);font-weight: bold;">{{ $user->email }}</td>
                            <td  style="background-color: rgb(223, 245, 153)">
                                <!-- Clickable Image for Ban with Modal Trigger -->
                                <a href="#" class="btn btn-sm" title="Ban" data-bs-toggle="modal" data-bs-target="#banModal{{ $user->id }}">
                                    <img src="{{ asset('ban.png') }}" alt="Category Image" style="max-height: 30;max-width: 60;">
                                </a>

                                <!-- Add more actions or customize as needed -->

                                <!-- Modal for Ban Confirmation -->
                                <div class="modal fade" id="banModal{{ $user->id }}" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: black;color:white;">
                                                <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="font-weight: bold">
                                                Are you sure you want to Ban  {{ $user->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <!-- Use a form to perform the PUT request -->
                                                <!-- Clickable Image for Ban with Button -->
                                                <button class="btn btn-sm btn-danger" title="Ban" onclick="unbanUser('{{ $user->id }}')">
                                                    <img src="{{ asset('ban.png') }}" alt="Ban User" style="max-height: 30; max-width: 60;">
                                                </button>
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
                <p>No users found</p>
                <!-- Centered Image -->
                <img src="{{ asset('notfound.png') }}" alt="No Data Image" style="max-height: 200;max-width: 200;">
            </div>
        @endif

        <!-- Element to display success or error message -->
        <div id="messageDisplay" class="text-center"></div>

    </div>
    <script>
        window.onload = function() {
            // Check the switch by default
            document.getElementById('notBanSwitch').checked = false;

            // Redirect to "/notban" route when the switch is checked
            document.getElementById('notBanSwitch').addEventListener('change', function () {
                window.location.href = this.checked ? "{{ url('/notban') }}" : "{{ url('/notban') }}";
            });
        };

        function unbanUser(userId) {
            // Get the element where you want to display the message
            var messageElement = document.getElementById('messageDisplay');

            // Call an API endpoint to ban the user
            fetch("{{ url('/banusers') }}/" + userId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // Additional options if needed
            })
            .then(response => response.json())
            .then(data => {
                // Display success message
                if (data.message) {
                    messageElement.innerText = data.message;

                    // Reload the page after a short delay
                    setTimeout(function() {
                        location.reload();
                    }, 10000); // 2500 milliseconds = 2.5 seconds
                } else {
                    // Display error message
                    messageElement.innerText = data.error;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection
