@extends('layouts.teacher.master')
@section('content')
    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
        <div class="profile-details">
            <div class="profile-title">
                <h3>Change Password</h3>
            </div>
            <div class="change-password">
                <form action="{{ route('teacher.update-password') }}" method="POST">
                    @csrf
                    <div class="row" style="justify-content: center;">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <label>Current Password</label><br>
                                <input name="old_password" type="password" class="text-field @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                placeholder="Old Password">
                                <i class="far fa-eye" id="togglePassword" style="position: absolute; margin-top: 12px; margin-left: -28px;"></i>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <label>New Password</label><br>
                                <input name="new_password" type="password" class="text-field @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                    <i class="far fa-eye" id="togglePassword1" style="position: absolute; margin-top: 12px; margin-left: -28px;"></i>
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <label>Confirm Password</label><br>
                                <input name="new_password_confirmation" type="password" class="text-field" id="confirmNewPasswordInput"
                                placeholder="Confirm New Password">
                                <i class="far fa-eye" id="togglePassword2" style="position: absolute; margin-top: 12px; margin-left: -28px;"></i>

                            </div>
                            <button type="submit">Save Change</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
@push('script')
<script>
       $(document).ready(function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#oldPasswordInput');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                // this.classList.toggle('fa-eye-slash');
                $(this).toggleClass('fa fa-eye fa-eye-slash');
            });
            const togglePassword1 = document.querySelector('#togglePassword1');
             const password1 = document.querySelector('#newPasswordInput');

             togglePassword1.addEventListener('click', function(e) {
                 // toggle the type attribute
                 const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                 password1.setAttribute('type', type);
                 // toggle the eye slash icon
                 // this.classList.toggle('fa-eye-slash');
                 $(this).toggleClass('fa fa-eye fa-eye-slash');
             });
             const togglePassword2 = document.querySelector('#togglePassword2');
             const password2 = document.querySelector('#confirmNewPasswordInput');

             togglePassword2.addEventListener('click', function(e) {
                 // toggle the type attribute
                 const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                 password2.setAttribute('type', type);
                 // toggle the eye slash icon
                 // this.classList.toggle('fa-eye-slash');
                 $(this).toggleClass('fa fa-eye fa-eye-slash');
             });
        });
    </script> 

    @endpush

