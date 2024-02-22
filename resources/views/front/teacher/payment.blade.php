@extends('layouts.teacher.master')
@section('content')
    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }
    </style>
    @php
        $student_enquiry1 = App\Models\Credit::where('teacher_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        //  dd($student_enquiry1);
    @endphp
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
        <div class="profile-details">
            <div class="profile-title">
                <h3>Generate Payment Link</h3>
            </div>
            <div class="change-password">
                <form action="{{ route('teacher.payment') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="">
                        @php
                            $tutors = DB::table('categories')
                                    ->where('parent', 0)
                                    ->where('status', 1)
                                    ->get();
                        @endphp

                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <label>Categories</label><br>
                            <select class="form-control" name="category" id="category">
                                <option value="" disaled>Select Category</option>
                                @foreach ($tutors as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category"></p>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3 d-none" id="sb1">
                            <label>Sub-categories</label><br>
                            <select class="form-control" name="sub_category" id="sub_category">
                            </select>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-sub-category"></p>
                        </div>

                        @php
                            $id = Auth::user()->id;
                            $user1 = DB::table('tutors')
                                ->where('user_id', $id)
                                ->first();
                            $latitude = $user1->lat;
                            $longitude = $user1->lng;
                            $student_enquiry = DB::table('book_a_classes')
                                ->select(
                                    'book_a_classes.id',
                                    'book_a_classes.first_name',
                                    'book_a_classes.user_id',
                                    DB::raw(
                                        '6371 * acos(cos(radians(' .
                                            $latitude .
                                            "))
                                                * cos(radians(book_a_classes.lat))
                                                * cos(radians(book_a_classes.lng) - radians(" .
                                            $longitude .
                                            "))
                                                + sin(radians(" .
                                            $latitude .
                                            "))
                                                * sin(radians(book_a_classes.lat))) AS distance",
                                    ),
                                )
                                ->orderBy('created_at', 'Desc')
                                ->get();

                            // $student = DB::table('users')
                            //     ->join('credits', 'users.id', '=', 'credits.student_id')
                            //     ->select('users.*')
                            //     ->get();
                            $student = DB::select(DB::raw("SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(student_id, ',', n.digit+1), ',', -1) student_id FROM credits INNER JOIN (SELECT 0 digit UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) n ON LENGTH(REPLACE(student_id, ',' , '')) <= LENGTH(student_id)-n.digit; "));

                        @endphp
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <label>Students</label><br>
                            <select class="form-control" name="student" id="student">
                                <option value="" disaled>Select student</option>
                                @foreach ($student_enquiry1 as $st1)
                                    @php
                                        $data = DB::table('users')
                                            ->where('id', $st1->student_id)
                                            ->first();
                                    @endphp
                                    @if (isset($data->name))
                                        <option value="{{ $st1->student_id }}">{{ $data->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-student"></p>
                        </div>
                        @php
                            $currency = DB::table('currency')->get();
                        @endphp
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <label>Currency</label><br>
                            <select class="form-control" name="currency" id="currency">
                                <option value="" disaled>Select Currency</option>
                                @foreach ($currency as $st1)
                                    <option value="{{ $st1->id }}">{{ $st1->currency }}({{ $st1->symbol }})</option>
                                @endforeach
                            </select>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-currency"></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <label>Boards</label><br>
                            <input name="board" type="text" class="text-field" id="board" style="width:100%">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-board"></p>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                            <label>Amonut</label><br>
                            <input name="amount" type="number" class="text-field" id="amount" style="width:100%">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-amount"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                        <button type="submit" style="margin-left: 0%;margin-top:0">Save Change</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
@push('script')
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            //on change country

            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                $('.pre-loader').show();

                var form = $(this);
                var data = new FormData($(this)[0]);
                var url = form.attr("action");
                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                $('.submit').attr('disabled', true);
                $('.form-control').attr('readonly', true);
                $('.form-control').addClass('disabled-link');
                $('.error-control').addClass('disabled-link');
                if ($('.submit').html() !== loadingText) {
                    $('.submit').html(loadingText);
                }
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.setTimeout(function() {
                            $('.submit').attr('disabled', false);
                            $('.form-control').attr('readonly', false);
                            $('.form-control').removeClass('disabled-link');
                            $('.error-control').removeClass('disabled-link');
                            $('.submit').html('Save');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("Email payment link send Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/teacher/payment-list";
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control]);
                                // $('#error-'+error_text).html(response.errors[error_text][0]);
                                // console.log('#error-'+error_text);
                            }
                            // console.log(response.errors);
                            $('.pre-loader').hide();
                        }
                    },
                    error: function(response) {
                        // alert("Error: " + errorThrown);
                        console.log(response);
                    }
                });
                event.stopImmediatePropagation();
                return false;
            });
            $(document).on('change', '#category', function() {
                var id = $('#category').val();
                    $.ajax({
                    type: "get",
                    url: "{{ route('teacher.st.sub-category') }}",
                    data: {
                        'category': id,
                        "_token": "{{ csrf_token() }}"
                    },


                    success: function(data) {
                        if (data.success == true) {
                            $("#sb1").removeClass('d-none');
                            $("#sub_category").empty();
                            $("#sub_category").append('<option value="">Select Sub Category</option>');
                            $.each(data.value, function(key, value) {
                                $("#sub_category").append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                        if (data.success == false) {
                            $("#sb1").addClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endpush
