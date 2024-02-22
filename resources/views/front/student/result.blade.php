@extends('layouts.student.master')
@section('content')
    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }

        .profile_picture_sec img {
            max-width: 100px;
            border-radius: 100px;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #4f94cf12; border-radius: 10px;">
        <div class="profile-details mt-4 m-2 for-respara">
            <div class="profile-title title-stures">
                <h1>Correct Answers Count</h1>
            </div>
                @if ($success)
                    <p>Total Correct Answers: {{ $correct_answer_count }}</p>
                @else
                    <p>No data available.</p>
                @endif


        </div>
    </div>
@endsection
