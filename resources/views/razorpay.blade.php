<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 8 Razorpay Payment Gateway - Tutsmake.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <style>
        .card-product .img-wrap {
            border-radius: 3px 3px 0 0;
            overflow: hidden;
            position: relative;
            height: 220px;
            text-align: center;
        }

        .card-product .img-wrap img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
        }

        .card-product .info-wrap {
            overflow: hidden;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .card-product .bottom-wrap {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .label-rating {
            margin-right: 10px;
            color: #333;
            display: inline-block;
            vertical-align: middle;
        }

        .card-product .price-old {
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4">
                <figure class="card card-product">
                    <figcaption class="info-wrap">
                        <div class="rating-wrap">
                        </div>
                        <!-- rating-wrap.// -->
                    </figcaption>
                    <div class="bottom-wrap">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now"
                            data-amount="1000" data-id="1">Pay Now</a>
                        <div class="price-wrap h5">
                            <span class="price-new">₹1</span>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.buy_now', function(e) {
            var totalAmount = $(this).attr("data-amount");
            var product_id = $(this).attr("data-id");
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (totalAmount * 1), // 2000 paise = INR 20
                "name": "ritu",
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paysuccess?payment_id=' + response
                        .razorpay_payment_id + '&product_id=' + product_id + '&amount=' + totalAmount;
                },
                "prefill": {
                    "contact": '8887870982',
                    "email": 'rp3567810@gmail.com',
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>
</body>

</html>
