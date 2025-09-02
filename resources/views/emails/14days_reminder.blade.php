<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email Verification!</title>
    <style>
@media only screen and (max-width: 620px) {
  table.body h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }

  table.body p,
table.body ul,
table.body ol,
table.body td,
table.body span,
table.body a {
    font-size: 16px !important;
  }

  table.body .wrapper,
table.body .article {
    padding: 10px !important;
  }

  table.body .content {
    padding: 0 !important;
  }

  table.body .container {
    padding: 0 !important;
    width: 100% !important;
  }

  table.body .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }

  table.body .btn table {
    width: 100% !important;
  }

  table.body .btn a {
    width: 100% !important;
  }

  table.body .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
  }

  .btn-primary table td:hover {
    background-color: #34495e !important;
  }

  .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important;
  }

  .primary-button{
    background: #FFB600;
    color: #011530;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    width: fit-content;
    font-weight: 400;
    font-size: 1rem;
    text-decoration: none;
    
  }

  .secondary-button{
      background: #fff;
      color: #011530;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 4px;
      width: fit-content;
      font-weight: 400;
      font-size: 1rem;
      text-decoration: none;

  }
}
</style>
  </head>
  <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Thank you for creating an account with us. </span>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <tr>

                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                    <tr>
                      
                      <div style=" width: 100%; text-align: center; padding: 20px 0; border-bottom: 1px solid #eee; margin-bottom: 20px;">
                      <img src="{{ asset('img/pictures/logo-light.png') }}" alt="logo" width="100px">
                      </div>
                        
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                                           
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Hello {{$customer_name}},</p>

                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Your {{ env('APP_NAME') }} subscription will expire in 15 days, on [date]. We hope you’ve enjoyed all the benefits {{ env('APP_NAME') }} was built to offer you.</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Good news! There’s still time to renew, and it’s as easy as ever – just click the link below, pick the subscription that suits your needs, and follow the prompts.</p>
                        

                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;" width="100%">
                        <tbody>
                            <tr>
                            <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                <tbody>
                                    <tr>
                                    <td> <a href="{{route('email.verification.link', ['token'=>$token])}}">{{route('email.verification.link', ['token'=>$token])}}</a></td>
                                    </tr>
                                </tbody>
                                </table>
                            </td>
                            </tr>
                        </tbody>
                        </table>

                        <p style="ffont-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">If you have any questions regarding your Package or renewal, please don’t hesitate to reach out by replying to this email.</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Best regards,</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">{{ env('APP_NAME') }}</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; margin-top: 10px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #999999; font-size: 12px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Copyright © {{ env('APP_NAME') }} {{date('Y')}}. All rights reserved.</span>
                    
                  </td>
                </tr>
               
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
