@extends('layouts.student.master')

@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    .setting-text {
        padding: 17px;
        background: #FFFFFF;
        box-shadow: 0px 0px 6px rgba(227, 227, 227, 0.85);
        border-radius: 10px;
        margin-bottom: 5px;
    }
</style>
<div class="col-xl-9 col-lg-8 col-md-12 p-md-4" style="background-color: #4f94cf12; border-radius: 10px;">

    <!-- <div class="profile-title">
        <h3>Setting</h3>
    </div> -->

    <div class="setting-text">
        <a href="{{ url('/student/change-password')}}">
            <p><i class="fa fa-unlock-alt"></i><span> Change Password</span></p>
        </a>
        <a href="#"><i class="fa fa-angle-right angle-des"></i></a>
    </div>
    <div class="setting-text">
        <a href="#" id="delete-account-link">
            <p>
                <i class="fa {{ Auth::user()->status == 1 ? 'fa-user-times' : 'fa-user-check' }}"
                   aria-hidden="true" id="status"
                   data-status="{{ Auth::user()->status }}"></i>
                 <span style="margin-left: 10px">Delete Your Account </span>
            </p>
        </a>
        <i class="fa fa-angle-right angle-des"></i>
    </div>
</div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#delete-account-link').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior

            // Show the SweetAlert confirmation dialog when the link is clicked
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete your account.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, make your AJAX request here to delete the account
                    var ajaxUrl = "{{ route('student.deactive') }}";
                    var requestData = {
                        "_token": "{{ csrf_token() }}",
                        "status": $('#status').attr('data-status')
                    };
                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: requestData,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    title: 'Account Deleted!',
                                    text: 'Your account has been deleted successfully.',
                                    icon: 'success',
                                }).then(() => {
                                    window.location = "{{ url('/') }}" + "/student/logout";
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting your account.',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
