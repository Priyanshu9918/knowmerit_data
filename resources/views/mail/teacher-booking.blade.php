<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
      @media only screen and (max-width: 600px) {
        .inner-body {
          width: 100% !important;
        }

        .footer {
          width: 100% !important;
        }
      }

      @media only screen and (max-width: 500px) {
        .button {
          width: 100% !important;
        }

        .f-14 {
          font-size: 14px !important;
          color: red;
        }
      }
    </style>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
      <tr>
        <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
          <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
            <tr>
              <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 80px auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                  <!-- Body content -->

                  <tr>
                    <td style="    text-align: center;
                    margin-top: 46px;
                    display: block;">
                      <img src="{{asset('assets/img/logo/logo.png')}}" width="50%">
                    </td>
                  </tr>
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Dear {{$t_name}}</p>

        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        You have a new lesson booking request from {{$s_name}}. Here are the details:</p>
        </p>
        <!-- <p>Your can now easily make your payment by following the link below:</p> -->
        <p><span>Student Name</span> : {{$s_name}}</p>
        <p><span>Class Name</span> : {{$class_name}}</p>
        <p><span>Date - time</span> : {{$class_time}}</p>
        <!-- <p><span>Time</span> : 12/02/2000</p> -->
        <!-- <p><span>Teacher</span> : sdfghjk</p> -->
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            <a href="{{$teacher_url}}"><button style=" padding: 10px 20px; border: none; border-radius: 7px; color: #fff; background-color: #009fff; font-size: 16px; font-weight: 500;"> Join Here</button></a>
        </p>
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Please confirm or decline this booking request by [Confirmation Deadline]. If you have any questions, please contact our support team.</p>
        </p>

        <h5>Thanks & Regards</h5>
        <p>The KnowMerit Team
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

<tr>
    <td>
    <table style="width:100%;" align="center">
      <tr align="center">
        <td style="text-align:center!important; font-weight:700; font-size:18px;" align="center"> Cheers </td>
      </tr>
      <tr style="text-align:center!important;">
        <td style="text-align:center!important; font-weight:700; font-size:18px;"> Know Merit Team </td>
      </tr>
      <tr style="text-align:center!important;">
        <td style="text-align:center!important;">
          <h5 style="margin-bottom: 9px;margin-top: 0px;font-size:25px;font-style: italic;font-family: 'Lobster', cursive;color: #000;">Share Us On </h5>
        </td>
      </tr>
      <tr style="text-align:center!important;">
        <td>
          <a href="https://www.instagram.com/knowmerit_education" target="_blank" style="text-decoration:none">
            <img src="{{ asset('instagram1.webp') }}" style="width: 6%;">
          </a>
          <a href="https://www.facebook.com/knowmerity" target="_blank" style="text-decoration:none">
            <img src="{{ asset('fb.png') }}" style="width: 6%;">
          </a>  
           <a href="https://twitter.com/KnowMerit" target="_blank" style="text-decoration:none">
            <img src="{{ asset('twitter.png') }}" style="width: 6%;margin-left: 15px;">
          </a>
          <a href="https://in.linkedin.com/company/knowmerit" target="_blank" style="text-decoration:none ">
            <img src="{{ asset('linkedin1.webp') }}" style="width: 6%;margin-left: 15px;">
          </a>
          <a href="https://www.youtube.com/channel/UCpFtWRari3irhNb1yzCjrLg" target="_blank" style="text-decoration:none">
            <img src="{{ asset('youtube.png') }}" style="width: 6%;margin-left: 15px;">
          </a>
        </td>
      </tr>
    </table>
    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #EDEFF2; margin-top: 25px; padding-top: 25px;">
      <tr>
        <td>
          <table style="width: 100%;">
            <tr style="text-align: center;display: table; margin: 0 auto;">
              <td class="f-14" style="border-right: 1px solid;
                      margin-right: 7px;
                      display: inline;
                      padding-right: 7px">
                <a href="http://merit.techsaga.live/privacy-policy" style="color:#000;text-decoration: none;    width: 30%; font-size:11px;">Privacy Policy</a>
              </td>
              <td class="f-14" style="border-right: 1px solid;
                      margin-right: 7px;
                      display: inline;
                      padding-right: 7px">
                <a href="http://merit.techsaga.live/refund-policy" style="color:#000;text-decoration: none;    width: 30%; font-size:11px;">Refund Policy</a>
              </td>
              <td class="f-14" style="width:30%; font-size:11px;">
                <a href="http://merit.techsaga.live/terms-and-conditions" style="
                          color:#000;
                          text-decoration: none;
                      ">Tearms of Use</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr style="text-align:center;">
        <td>© Copyrights Know Merit Corporations.2023 All rights reserved. <br> West Delhi, India - 110058 </td>
      </tr>
    </table>
    </td>
    </tr>

</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>


