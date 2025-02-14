<html>
   <head>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <meta content="width=device-width" name="viewport">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <title><?=$title?></title>
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
   </head>
   <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #ffffff;">
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
      <table bgcolor="#ffffff" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;" valign="top" width="100%">
         <tbody>
            <tr style="vertical-align: top;" valign="top">
               <td style="word-break: break-word; vertical-align: top;" valign="top">
                  <div style="background-color:transparent;">
                     <div class="block-grid" style="min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;Margin: 0 auto;background-color: #2b7797;border-left: 1px solid #fbf5ee;border-right: 1px solid #fbf5ee;">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#2b7797;">
                           <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;width: 600px;">
                              <div class="col_cont" style="width:100% !important;">
                                 <div style="border-top:0px solid transparent;border-left:0px solid transparent;border-bottom:0px solid transparent;border-right:0px solid transparent;padding-top: 20px;padding-bottom: 20px;padding-right: 0px;padding-left: 0px;">
                                    <div align="center" class="img-container center fixedwidth" style="padding-right: 0px;padding-left: 0px;">
                                       <a href="<?=base_url()?>" style="outline:none" tabindex="-1" target="_blank"><img align="center" alt="Logo" border="0" class="center fixedwidth" src="<?=$company_logo?>" style="text-decoration: none;-ms-interpolation-mode: bicubic;height: auto;border: 0;width: 100%;max-width: 90px;display: block;" title="Logo" width="128"></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>