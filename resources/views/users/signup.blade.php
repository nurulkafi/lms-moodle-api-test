@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Users</h4>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                    @endif
                    <form id="signupForm" action="{{ url('/signup') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="Enter First Name" value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Enter Username" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Enter Password">
                            <div id="passwordRequirements" class="text-danger mt-2"></div>
                        </div>
                        <div class="float-end mt-3">
                            <button id="createBtn" class="btn btn-primary" type="submit" disabled>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#password').on('keyup', function () {
                var password = $(this).val();
                var passwordRequirements = $('#passwordRequirements');
                var valid = true;

                // Validate length
                if (password.length < 8) {
                    valid = false;
                    passwordRequirements.text('Password must be at least 8 characters long.');
                } else {
                    passwordRequirements.text('');
                }

                // Validate digit
                if (!/\d/.test(password)) {
                    valid = false;
                    passwordRequirements.append('<br>Password must contain at least 1 digit.');
                }

                // Validate uppercase letter
                if (!/[A-Z]/.test(password)) {
                    valid = false;
                    passwordRequirements.append('<br>Password must contain at least 1 uppercase letter.');
                }

                // Validate special character
                if (!/[\*\-\#]/.test(password)) {
                    valid = false;
                    passwordRequirements.append('<br>Password must contain at least 1 special character (*, -, or #).');
                }

                // Enable or disable submit button based on validation result
                if (valid) {
                    $('#createBtn').prop('disabled', false);
                } else {
                    $('#createBtn').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
