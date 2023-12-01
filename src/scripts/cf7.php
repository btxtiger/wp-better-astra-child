<?php

// Activate Shortcode Execution for Contact Form 7
add_filter( 'wpcf7_form_elements', 'do_shortcode' );

function wrap_cf7_email_body($components, $contact_form, $mail) {
   $body = $components['body'];
   $mailStyle = "
      <style>
          body { font-size: 16px; }
          table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
          th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
          th { background-color: #f2f2f2; }
          h1, h2, h3, h4, h5, h6 { margin: 16px 0; }
          h1 { font-size: 2em; }
          h2 { font-size: 1.5em; }
          @media screen {
              body { max-width: 1100px; }
          }
          @media print {
              body { width: 210mm; height: 297mm; margin: 25mm 25mm 20mm 25mm; font-size: 12pt; }
              table { width: 100%; max-width: 100%; border-collapse: collapse; }
              th, td { border: 1px solid grey; padding: 8px; text-align: left; }
          }
      </style>
   ";
   $mailMetaInfo = "
      <hr />
      <h3>Absender Information</h3>
      <table>
          <tr>
              <td>Time</td>
              <td>[_date], [_time]</td>
          </tr>
          <tr>
              <td>URL</td>
              <td><b>[_post_title]</b> ([_post_url])</td>
          </tr>
          <tr>
              <td>IP</td>
              <td>[_remote_ip]</td>
          </tr>
          <tr>
              <td>UserAgent</td>
              <td>[_user_agent]</td>
          </tr>
      </table>
      <p>Diese E-Mail wurde vom Formular von <b>[_site_title]</b> ([_site_url]) gesendet.</p>
   ";

   $mailDoc = "
      <!DOCTYPE html>
      <html lang='en'>
         <head>
            <meta charset='utf-8'>
            <title>CF7 Email</title>
            $mailStyle
         </head>
         <body>
            $body
            $mailMetaInfo
         </body>
      </html>
   ";

   $components['body'] = $mailDoc;

   return $components;
}
add_filter('wpcf7_mail_components', 'wrap_cf7_email_body', 10, 3);
