<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta name="viewport" content="width=device-width" />
      <title><?=$title?></title>
      <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
   </head>
   <body style="margin: 0;padding: 0;position: relative;">
   <?php
   $get_settings = get_admin_settings();
   $company_logo = '';
   foreach($get_settings as $single_settings){
      if($single_settings['name'] == 'company_logo'){
         $company_logo = ASSET.'images/'.$single_settings['value'];
      }
   }
   if(empty($company_logo)){
      $company_logo = ASSET.'images/logo.svg';
   }
   ?>
      <center>
         <table style="width:600px;  border-spacing:0; vertical-align:middle; padding:0;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;" cellspacing="0" cellpadding="0" border="0" >
            <thead>
               <tr>
                  <td style="padding:0;margin:0;vertical-align:middle;">
                     <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #2b7797;text-align: center;" cellspacing="0" cellpadding="0" border="0">
                        <thead>
                           <tr>
                              <th style="text-align:center;padding: 20px 0 20px 0;margin:0;vertical-align: middle;">
                                 <a href="<?=BASE_URL?>" style="display:block;padding:0;margin:0;vertical-align: middle;" >
                                    <img style="padding:0;margin:0;vertical-align: middle;" src="<?=$company_logo?>" width="90px" alt=""/>
                                 </a>
                              </th>
                           </tr>
                        </thead>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td style="background: #4990e2 ; height:auto; width:100%; display:block;padding:0;margin:0;vertical-align:middle;">
                     <center>
                        <table style="width:100%; padding:0;" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="text-align: center;padding: 20px 0;background: #fbf5ee;margin: 0;vertical-align: middle;">
                                 <a href="" style="display: block;padding: 0;margin: 0;vertical-align: middle;font-family: Montserrat;font-size: 18px;color: rgba(0,0,0,0.90);line-height: 18px;text-decoration: none;text-transform: uppercase;font-weight: 700;" >
                                 <img style="padding:0;margin:0;vertical-align: middle;margin-right: 18px;" src="<?=ASSET?>images/emails/welcome.png" alt=""/>
                                 Thank you
                                 </a>
                              </td>
                           </tr>
                        </table>
                     </center>
                  </td>
               </tr>