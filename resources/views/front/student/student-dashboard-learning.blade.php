@extends('layouts.student.master')
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
         <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">

            <div class="tab-content">
               <div class="tab-pane fade" id="enquiries">

               </div>
               <div class="tab-pane fade active show" id="upcoming">
                  <div class="settings-top-widget">
                     <!-- No Upcoming Task Start -->
                     <div class="row d-none">
                        <div class="no-up">
                           <div class="no-upcomimg">
                              <img src="assets/img/my-img/clipboard1.png">
                              <h3 class="mt-4">No Upcoming Task </h3>
                           </div>
                        </div>
                     </div>
                     <!-- No Upcoming Task End -->
                     <!--Your Classrooms listing start -->
                     <div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="settings-widget">
                                 <div class="settings-inner-blk p-0">
                                    <div class="comman-space " style="background-color: #009fff;">
                                       <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                          <table class="table table-nowrap mb-2 dash-table">
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <div class="sell-table-group d-flex align-items-center">
                                                         <div class="sell-tabel-info">
                                                            <h3><a class="#" data-bs-toggle="collapse" href="#faqone" aria-expanded="true"><span style="font-size:24px;">Dance Fitness Trainers</span><span style="font-size: 14px;display: block;color: #999;" class="">No Demo Booked yet - 0  Connected </span> </a></h3>
															<span class="top-view-c2 mb-2 d-inline-block">Online Class</span>
															<span class="top-view-c2 mb-2 d-inline-block">Mathematics</span>
                                                            <div class="">
                                                               <h6 class="mt-2"> <i class="fa-solid fa-calendar-days"></i> Book a demo</h6>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </td>
                                                   <td style="float: right;"> <span class="badge info-low">Open</span> </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="sell-table-group d-flex align-items-center">
                                                         <div class="sell-tabel-info">
                                                            <h3><a class="#" data-bs-toggle="collapse" href="#faqone" aria-expanded="true"><span style="font-size:24px;">Class I-V Tuition</span><span style="font-size: 14px;display: block;color: #999;" class="">No Demo Booked yet - 0  Connected </span> </a></h3>
															<span class="top-view-c2 mb-2 d-inline-block">Online Class</span>
															<span class="top-view-c2 mb-2 d-inline-block">Mathematics</span>
                                                            <div class="">
                                                               <h6 class="mt-2"> <i class="fa-solid fa-calendar-days"></i> Book a demo</h6>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </td>
                                                   <td style="float: right;"> <span class="badge info-low">Open</span> </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Your Classrooms listing End -->
                     <!-- Your Classrooms Details start -->

                     <!-- Your Classrooms Details End -->
                  </div>
               </div>
            </div>
         </div>
<script type="text/javascript">
   $('.tab-value').click(function(){
     var t = $(this).text();
     $('#addbtn').html('Add'+t);
   });
</script>
