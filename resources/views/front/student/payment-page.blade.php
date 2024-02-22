<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    </head>
    <style>
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
    </style>
<body>
<div class="form-gap"></div>
<div class="container">
        <table>
        <thead>
            <tr>
            <th>Teacher Name</th>
            <th>Category</th>
            <th>Board</th>
            <th>Amount</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                @php $user = DB::table('users')->where('id',$data->teacher_id)->first(); @endphp
                @php $user1 = DB::table('users')->where('id',$data->student_id)->first(); @endphp
                <td data-column="First Name">{{$user->first_name ?? ''}}</td>
                @php $cat = DB::table('categories')->where('id',$data->category)->first(); @endphp
                <td data-column="Last Name">{{$cat->name ?? ''}}</td>
                <td data-column="Job Title">{{$data->board ?? ''}}</td>
                <td data-column="Twitter">{{$data_currency->symbol}} {{$data->amount ?? ''}}</td>
                <td><a href="javascript:void(0)" id="payment" class="btn btn-primary" data-user="{{$user1->first_name}}" data-id="{{$data->id}}" data-amount="{{$data->amount}}" data-currency="{{$data_currency->code}}">Payment</a></td>
                </tr>
        </tbody>
        </table>
	</div>
</div>
</body>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '#payment', function(e) {
            var id = $(this).attr('data-id');
            var amount = $(this).attr('data-amount');
            var first_name = $(this).attr('data-user');
            var currencyCode = $(this).attr('data-currency');

            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100),
                "currency": currencyCode,
                "name": first_name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paybook?payment_id=' + response
                        .razorpay_payment_id + '&amount=' + amount + '&id=' + id;
                },
                "prefill": {
                    "contact": +123,
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });

        // var SITEURL = '{{ URL::to('') }}';
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $('body').on('click', '#payment', function(e) {
        //         var id = $(this).attr('data-id');
        //         var amount = parseFloat($(this).attr('data-amount'));
        //         var first_name = $(this).attr('data-user');
        //         var currencyCode = $(this).attr('data-currency');

        //         // Perform currency conversion here using an API (Open Exchange Rates in this case)
        //         $.ajax({
        //             url: 'https://open.er-api.com/v6/latest',
        //             dataType: 'json',
        //             success: function(data) {
        //                 var exchangeRate = data.rates[currencyCode];
        //                 var convertedAmount = amount / exchangeRate;

        //                 var options = {
        //                     "key": "{{ env('RAZAR_CLIENT_ID') }}",
        //                     "amount": (convertedAmount * 100), // Converted amount
        //                     "currency": currencyCode,
        //                     "name": first_name,
        //                     "description": "Payment",
        //                     "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
        //                     "handler": function(response) {
        //                         window.location.href = SITEURL + '/' + 'paybook?payment_id=' + response.razorpay_payment_id + '&amount=' + amount + '&id=' + id;
        //                     },
        //                     "prefill": {
        //                         "contact": +123,
        //                     },
        //                     "theme": {
        //                         "color": "#528FF0"
        //                     }
        //                 };

        //                 var rzp1 = new Razorpay(options);
        //                 rzp1.open();
        //                 e.preventDefault();
        //             }
        //         });
        //     });

</script>
</html>