
    <!-- header-start -->
    <header>
      <div class="menu-area">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-xs-9">
              <div class="logo">
                <a href="#">
                  <img src="{{asset('landing/img/logo.png')}}" alt="">
                </a>
              </div>
            </div>
            <div class="col-md-9 hidden-sm hidden-xs">
              <div class="menu">
                <ul>
                  <li data-toggle="modal" data-target="#bookfreedemo">
                    <a href="javascript:">Book a Free Demo Class
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-envelope-o" aria-hidden="true"></i> info@knowmerit.com </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="modal fade" id="bookfreedemo" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Book a Free Demo Class
        </h4>
        </div>
        <div class="modal-body">
            <form class="well form-horizontal" action="{{ route('landing.mathstwo') }}" method="POST" id="createFrm1">
                @csrf

                  <!-- Text input-->
                  <div class="form-group">
                    <div class="col-md-12 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <input name="first_name" placeholder="Full Name" class="form-control" type="text">
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-first_name"></p>
                      </div>
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="form-group">
                    <div class="col-md-12 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <input name="email" placeholder="Email" class="form-control" type="email">
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-email"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-earphone"></i>
                        </span>
                        <input name="phone" placeholder="Phone Number" class="form-control" type="number">
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-phone"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12 selectContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-list"></i>
                        </span>
                        <select name="gender" class="form-control selectpicker">
                          <option value="">Gender</option>
                          <option>Male</option>
                          <option>Female</option>
                          <option>Other</option>
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-gender"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-book"></i>
                        </span>
                        <input name="subject" placeholder="Subject, Grade / Year that you offer " class="form-control" type="text">
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-subject"></p>
                      </div>
                    </div>
                  </div>
                  <!-- Text input-->
                  <!-- Select Basic -->
                  <!-- Button -->
                  <div class="form-group text-center mar-top-30">
                   <button type="submit" class="btn btn-info">Book Now <span class="glyphicon glyphicon-send"></span>
                      </button>
                  </div>
                </fieldset>
              </form>
        </div>

      </div>

    </div>
  </div>
  @push('script')
  <script>
     $(document).on('submit', 'form#createFrm1', function(event) {
         event.preventDefault();
         //clearing the error msg
         $('p.error_container').html("");

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
                     toastr.success("Book Your Free Demo Classes Successfully");
                     // redirect to google after 5 seconds
                     window.setTimeout(function() {
                         window.location = "{{ url('/') }}" + "/maths";
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
  </script>
  @endpush
