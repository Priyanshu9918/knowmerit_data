@include('mail.header')
<!-- Email Body -->
{{-- @php
    $aa = Session::get('ist_id');
    $tutor  = DB::table('tutors')->where('user_id',$aa)->first();
    dd($tutor);
@endphp --}}


<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Hi {{ $bill_details->name }}</p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Your payment for Invoice {{ $bill_details->order_number }} has been successfully received. Below are the details of your payment:

           <p> Payment Date: {{ date('d-m-Y') }}</p>
           <p> Amount Paid: {{ $bill_details->amount }}</p>
           <p> Invoice Number: {{ $bill_details->order_number }}</p>
           <p> Payment Method: Online</p>

            If you have any questions or need a copy of your invoice, please feel free to contact our support team.

            Thank you for choosing KnowMerit.</p>
        </p>

        <h5>Thanks & Regards</h5>
        <p>The KnowMerit Team
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

@include('mail.footer')
