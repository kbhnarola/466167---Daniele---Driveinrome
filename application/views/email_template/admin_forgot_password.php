<!Doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <style type="text/css">
        body {
           background-color: #f6f6f6;
           font-family: sans-serif;
           -webkit-font-smoothing: antialiased;
           font-size: 14px;
           line-height: 1.4;
           margin: 0;
           padding: 0;
           -ms-text-size-adjust: 100%;
           -webkit-text-size-adjust: 100%;
         }
         table {
           border-collapse: separate;
           mso-table-lspace: 0pt;
           mso-table-rspace: 0pt;
           width: 100%;
         }
         table td {
           font-family: sans-serif;
           font-size: 14px;
           vertical-align: top;
         }
           /* -------------------------------------
             BODY & CONTAINER
             ------------------------------------- */
             .body {
               background-color: #f6f6f6;
               width: 100%;
             }
             /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */

             .container {
               display: block;
               margin: 0 auto !important;
               /* makes it centered */
               max-width: 680px;
               padding: 10px;
               width: 680px;
             }
             /* This should also be a block element, so that it will fill 100% of the .container */

             .content {
               box-sizing: border-box;
               display: block;
               margin: 0 auto;
               max-width: 680px;
               padding: 10px;
             }
           /* -------------------------------------
             HEADER, FOOTER, MAIN
             ------------------------------------- */

             .main {
               background: #fff;
               border-radius: 3px;
               width: 100%;
             }
             .wrapper {
               box-sizing: border-box;
               padding: 20px;
             }
             .footer {
               clear: both;
               padding-top: 10px;
               text-align: center;
               width: 100%;
             }
             .footer td,
             .footer p,
             .footer span,
             .footer a {
               color: #999999;
               font-size: 12px;
               text-align: center;
             }
             hr {
               border: 0;
               border-bottom: 1px solid #f6f6f6;
               margin: 20px 0;
             }
           /* -------------------------------------
             RESPONSIVE AND MOBILE FRIENDLY STYLES
             ------------------------------------- */

             @media only screen and (max-width: 620px) {
               table[class=body] .content {
                 padding: 0 !important;
               }
               table[class=body] .container {
                 padding: 0 !important;
                 width: 100% !important;
               }
               table[class=body] .main {
                 border-left-width: 0 !important;
                 border-radius: 0 !important;
                 border-right-width: 0 !important;
               }
             }
           </style>
       </head>
       <body class="">
        <table border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
           <td> </td>
           <td class="container">
            <div class="content">
              <!-- START CENTERED WHITE CONTAINER -->
              <table class="main">
                <!-- START MAIN CONTENT AREA -->
                <tr>
                 <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td>
                        <h2></h2>
                        <h3 style="text-align: justify; ">
                           <span style="font-size: 14pt;">Hello <?php echo $username;?>,</span>
                        </h3>
                        <p style="text-align: justify; "><span style="font-size: 13px; letter-spacing: normal;">Someone, hopefully, you, has requested to reset the password for your&nbsp;</span><?php echo SITE_TITLE;?> account with email <b><?php echo $email;?></b>.</p>
                        <span style="font-size: 13px; letter-spacing: normal; color: inherit; font-family: inherit;">
                           <p style="text-align: justify;"><span style="color: inherit; font-family: inherit;">If you did not perform this request, you can safely ignore this email&nbsp;</span>and your password will remain the same.&nbsp;<span style="color: inherit; font-family: inherit;">Otherwise, click the link below to complete the process.</span></p>
                           <p style="text-align: justify;"><a href="<?php echo $reset_password_link;?>" target="_blank" style="font-family: inherit; background-color: rgb(255, 255, 255);">Reset Password</a></p>
                           <p style="text-align: justify;">Please note that this link is valid for next 1 hour only. You won't be able to change the password after the link gets expired.</p>
                        </span>
                        <p></p>
                        <p style="text-align: justify; "><span style="font-size: 13px; letter-spacing: normal; color: inherit; font-family: inherit;">Regards,</span></p>
                        <p style="text-align: justify; "><span style="color: inherit; font-family: inherit; font-size: 13px; letter-spacing: normal;"><?php echo SITE_TITLE;?></span></p>
                       </td>
                    </tr>
                  </table>
                 </td>
                </tr>
                <!-- END MAIN CONTENT AREA -->
              </table>
              <!-- START FOOTER -->
              <div class="footer">
                <table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="content-block">
                      <!-- <span>You are receiving this email because of your account on {company_name}</span> -->
                    </td>
                  </tr>
                </table>
              </div>
            <!-- END FOOTER -->
            <!-- END CENTERED WHITE CONTAINER -->
          </div>
          </td>
          <td> </td>
          </tr>
        </table>
       </body>
</html> 