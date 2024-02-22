</script><link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<style>
    .toastui-calendar-timegrid-now-indicator{
        display: none !important;
    }
</style>
@if(count($events)>0)
    <div class="container p-0 py-md-2" style="height: 100% !important;">
        <button class="btn btn-primary btn-prev"> <i class="fa fa-angle-left"></i></button>
        <button class="btn btn-primary btn-today">Today</button>
        <button class="btn btn-primary btn-nxt"> <i class="fa fa-angle-right"></i></button>
        <div id="container" style="min-height: 600px !important;height:600px"></div>
    </div>

    <script>


        function cal_init_book()
        {
            var Cal = tui.Calendar;
            var calendar = new Cal('#container', {
                defaultView: 'week',
                taskView: false,
                id: 'cal1',
                isReadOnly: true,
            });
            calendar.setOptions({
                week: {
                    taskView: false,
                    eventView: ['time'],
                    defaultTimeDuration : 30,
                }
            });
            calendar.createEvents(@json($events));

            var timedEvent = calendar.getEvent('1', 'cal1'); // EventObject
            calendar.on('clickEvent', ({ event }) => {
                console.log(event); // EventObject
                $('#date_time').val(event.body);

                console.log(event.attendees[0]);
                if(event.attendees[0]=='B')
                {
                    return false;
                }else{
                    $.confirm({
                    title: 'Confirm!',
                    content: "You want to book "+event.body+" time slot ",
                    buttons: {
                        confirm: function () {
                        var data = $('#boking_form').serialize();
                        $.ajax({
                            url: "{{ route('admin.book_session') }}",
                            type: 'GET',
                            data: data,
                            dataType: 'json',
                            success: function(data) {
                                if(data.status==true)
                                {

                                toastr.success("Booking created Successfully");

                                window.setTimeout(function() {
                                    setTimeout(function(){ window.location = data.url; }, 2000);
                                }, 2000);
                                }
                                else{
                                    Swal.fire('Oops',data.msg,'');
                                }
                            }
                        });
                        },
                        cancel: function () {
                            $.alert('Canceled!');
                        },
                        somethingElse: {
                            text: 'Something else',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                $.alert('Something else?');
                            }
                        }
                    }
                });
                // Swal.fire({
                //     title: 'Are you sure?',
                //     text: "You want to select "+event.body+" time slot ",
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         // Swal.fire(
                //         // 'Deleted!',
                //         // 'Please submit form get the changes',
                //         // // 'success'
                //         // );

                //     }
                // })
            }
            });

            $(document).on("click", ".btn-prev", function() {
                calendar.prev();
            });
            $(document).on("click", ".btn-nxt", function() {
                calendar.next();
            });
            $(document).on("click", ".btn-today", function() {
                calendar.today();
            });
        }
        </script>
@else
<div class="container text-center">
    We regretfully inform you that, at this moment, we do not have any available slots for the desired teacher.Thank you for your understanding and patience. We appreciate your interest and look forward to assisting you in the future.
    <div class="row mt-5">
        <div class="offset-3 col-6">
            <a class="btn btn-primary" href="{{ route('student.sbac') }}">Explore more</a>
        </div>
    </div>
</div>
@endif
