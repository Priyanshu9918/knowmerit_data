@extends('layouts.teacher.master')
@section('content')
<style type="text/css">
   .user-nav a.dropdown-toggle {
   display: block;
   }
   span.top-view-c2{
		padding: 3px 6px;
   }
   .settings-inner-blk table tbody tr:last-child{
		border: 5px solid #009fff !important;
   }
   .dash-table td {
		padding: 1rem 35px!important;
	}
</style>
         <div class="col-xl-9 col-lg-8 col-md-12">
			<h3> MCQs  </h3>
         <form action="" method="POST" id="createFrm" enctype="multipart/form-data">
            @csrf
            <div id="Chemistry" class="question-div">
                  @if(count($mcq)>0)
                     @foreach($mcq as $key=>$mcqs)
                     @php
                        $ans2 = DB::table('submit_mcqs')->where('question_id',$mcqs->id)->first();
                     @endphp
                     <div class="questions btmborder">
                        <label>{{$key+1}}. {{$mcqs->Questions ?? 'no question'}}</label>
                        <input type="hidden" name="type_id" value="{{$mcqs->mcq_type_id}}">
                        <input type="hidden" name="mcq_id[]" value="{{$mcqs->id}}">
                           <div class="">
                                  <input type="radio" name="ans[{{$mcqs->id}}]" value="1" @if($ans2->answer == 1) Checked @endif required>
                                  <label for="">{{$mcqs->ans1 ?? ''}}</label>
                           </div>
                           <div class="">
                                  <input type="radio" name="ans[{{$mcqs->id}}]" value="2"  @if($ans2->answer == 2) Checked @endif required>
                                  <label for="">{{$mcqs->ans2 ?? ''}}</label>
                           </div>
                           <div class="">
                                  <input type="radio" name="ans[{{$mcqs->id}}]" value="3"  @if($ans2->answer == 3) Checked @endif required>
                                  <label for="">{{$mcqs->ans3 ?? ''}}</label>
                           </div>
                              <div class="">
                                  <input type="radio" name="ans[{{$mcqs->id}}]" value="4"  @if($ans2->answer == 4) Checked @endif required>
                                  <label for="">{{$mcqs->ans4 ?? ''}}</label>
                           </div>
                     </div>
                     @endforeach
                    @endif
                    {{--<div class="questions">
                       <label>2. Which of the following is a classification of Organic compounds?</label>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">alicyclic compounds and acyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Cyclic compounds and alicyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and acyclic compounds</label>
                          </div>
                           <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and linear chain compounds/label>
                          </div>
                    </div>
                    <div class="questions">
                       <label>3. Which of the following is a classification of Organic compounds?</label>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">alicyclic compounds and acyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Cyclic compounds and alicyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and acyclic compounds</label>
                          </div>
                           <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and linear chain compounds/label>
                          </div>
                    </div>
                    <div class="questions">
                       <label>4. Which of the following is a classification of Organic compounds?</label>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">alicyclic compounds and acyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Cyclic compounds and alicyclic compounds</label>
                          </div>
                          <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and acyclic compounds</label>
                          </div>
                           <div class="">
                                <input type="radio" name="second-question" value="">
                                <label for="">Open chain compounds and linear chain compounds/label>
                          </div>
                    </div>--}}
                  </div>
                  <!-- <div class="next-icon">
                    <button type="submit" class="submit">Submit</button>
                  </div> -->
                  </form>
         </div>
         @endsection
@push('script')
<script type="text/javascript">
   $('.tab-value').click(function(){
     var t = $(this).text();
     $('#addbtn').html('Add'+t);
   });

//    $(document).ready(function() {
//       //on change country

//       $(document).on('submit', 'form#createFrm', function(event) {
//             event.preventDefault();
//             //clearing the error msg
//             $('p.error_container').html("");
//             var title = $('div.iti__selected-flag').attr('title');

//             var form = $(this);
//             var data = new FormData($(this)[0]);
//             data.append("c_code", title);
//             var url = form.attr("action");
//             var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
//             $('.submit').attr('disabled', true);
//             $('.form-control').attr('readonly', true);
//             $('.form-control').addClass('disabled-link');
//             $('.error-control').addClass('disabled-link');
//             if ($('.submit').html() !== loadingText) {
//                $('.submit').html(loadingText);
//             }
//             $.ajax({
//                type: form.attr('method'),
//                url: url,
//                data: data,
//                cache: false,
//                contentType: false,
//                processData: false,
//                success: function(response) {
//                   window.setTimeout(function() {
//                         $('.submit').attr('disabled', false);
//                         $('.form-control').attr('readonly', false);
//                         $('.form-control').removeClass('disabled-link');
//                         $('.error-control').removeClass('disabled-link');
//                         $('.submit').html('Save');
//                   }, 2000);
//                   //console.log(response);
//                   if (response.success == true) {
//                         //notify
//                         toastr.success("MCQs Submitted successfully!");

//                         // Swal.fire({
//                         //     position: 'top-end',
//                         //     icon: 'success',
//                         //     title: 'user Created Successfully',
//                         //     showConfirmButton: false,
//                         //     timer: 1500
//                         //     })
//                         window.setTimeout(function() {
//                            window.location = "{{ url('/') }}" +
//                               "/student/student-dashboard";
//                         }, 2000);

//                   }
//                   //show the form validates error
//                   if (response.success == false) {
//                         for (control in response.errors) {
//                            var error_text = control.replace('.', "_");
//                            $('#error-' + error_text).html(response.errors[control]);
//                            // $('#error-'+error_text).html(response.errors[error_text][0]);
//                            // console.log('#error-'+error_text);
//                         }
//                         // console.log(response.errors);
//                   }
//                },
//                error: function(response) {
//                   // alert("Error: " + errorThrown);
//                   console.log(response);
//                }
//             });
//             event.stopImmediatePropagation();
//             return false;
//       });

//       $('#mysummernote').summernote({
//             height: 150
//       });
//       $('#mysummernote1').summernote({
//             height: 150
//       });
//       $('#mysummernote2').summernote({
//             height: 150
//       });
//    });
</script>
@endpush
