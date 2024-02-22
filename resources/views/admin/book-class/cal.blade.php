<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js">
</script><link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
<style>
    .toastui-calendar-timegrid-now-indicator{
        display: none !important;
    }
    .toastui-calendar-event-time {
            width: 100% !important;
            left: 0px !important;
            margin-left: 0px !important;
        }

</style>

    <div class="container p-0 py-md-2" style="height: 100% !important;">
        <button class="btn btn-primary btn-prev"> <i class="fa fa-angle-left"></i></button>
        <button class="btn btn-primary btn-today">Today</button>
        <button class="btn btn-primary btn-nxt"> <i class="fa fa-angle-right"></i></button>
        <div id="container" style="min-height: 600px !important;height:600px"></div>
    </div>
    <script>


        function cal_init()
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
                    showTimelineArrowOnFullDayView: false,
                },
                timeFormat: 'HH:mm',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12:true
                },

            });
            calendar.createEvents(@json($events));

            var timedEvent = calendar.getEvent('1', 'cal1'); // EventObject
            calendar.on('clickEvent', ({ event }) => {
                console.log(event); // EventObject
                $('#date_time').val(event.body);


            console.log(event.attendees[0]);
            if(event.attendees[0]=='B' || event.attendees[0]=='D')
            {
                return false;
            }else{
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to select "+event.body+" time slot ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                        // 'Deleted!',
                        // 'Please submit form get the changes',
                        // // 'success'
                        // );
                        var data = $('#boking_form').serialize();
                        $.ajax({
                            url: "{{ route('admin.book.session') }}",
                            type: 'GET',
                            data: data,
                            dataType: 'json',
                            success: function(data) {
                                if(data.status==true)
                                {
                                    Swal.fire('Done',data.msg,'');
                                    setTimeout(function(){ window.location = data.url; }, 2000);
                                    // setTimeout(function(){ location.reload(); }, 2000);

                                }
                                else{
                                    Swal.fire('Oops',data.msg,'');
                                }
                            }
                        });
                    }
                })
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

