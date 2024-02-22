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
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6; height: 700px;">
        <div class="profile-details mt-3">
            <!-- <div class="profile-title">
                <h1>Compiler</h1>
            </div> -->
            <iframe id="iframedata" src="https://onecompiler.com/embed" width="100%" height="720" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>
                <!-- <iframe src="https://www.online-ide.com/SIwoiJeQ3H" width="100%" height="900" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe> -->
                    <!-- <iframe height="300" style="width: 100%;" scrolling="no" title="Untitled" src="https://codepen.io/sdfghj-the-looper/embed/jOdrajR?default-tab=html%2Cresult" frameborder="no" loading="lazy" allowtransparency="true" allowfullscreen="true">
                        See the Pen <a href="https://codepen.io/sdfghj-the-looper/pen/jOdrajR">
                        Untitled</a> by sdfghj (<a href="https://codepen.io/sdfghj-the-looper">@sdfghj-the-looper</a>)
                        on <a href="https://codepen.io">CodePen</a>.
                    </iframe> -->
        </div>
    </div>
@endsection
