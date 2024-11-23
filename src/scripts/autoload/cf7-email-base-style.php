<?php


function astc_wrap_cf7_email_body($components, $contact_form, $mail) {
   $body = $components['body'];

   // if $body is already html doc, then return
   if (strpos($body, '<!DOCTYPE html') !== false) {
      return $components;
   }

   $mailStyle = "
      <style>
          body { font-size: 16px; font-family: Tahoma, 'Helvetica Neue', Arial, sans-serif; }
          table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
          th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
          th { background-color: #f8f8f8; font-weight: normal; }
          td { width: 50%; }
          h1, h2, h3, h4, h5, h6 { margin-top: 2em; margin-bottom: 1em; font-weight: 600; }
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
         </body>
      </html>
   ";

   $components['body'] = $mailDoc;

   return $components;
}
add_filter('wpcf7_mail_components', 'astc_wrap_cf7_email_body', 10, 3);
