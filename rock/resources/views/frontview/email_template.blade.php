<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=320, initial-scale=1" />
  <title>RockIt Email Confirm</title>
  <style type="text/css">

    /* ----- Client Fixes ----- */

    /* Force Outlook to provide a "view in browser" message */
    #outlook a {
      padding: 0;
    }

    /* Force Hotmail to display emails at full width */
    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    /* Force Hotmail to display normal line spacing */
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }


     /* Prevent WebKit and Windows mobile changing default text sizes */
    body, table, td, p, a, li, blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    /* Remove spacing between tables in Outlook 2007 and up */
    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    /* Allow smoother rendering of resized image in Internet Explorer */
    img {
      -ms-interpolation-mode: bicubic;
    }

     /* ----- Reset ----- */

    html,
    body,
    .body-wrap,
    .body-wrap-cell {
      margin: 0;
      padding: 0;
      background: #ffffff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      text-align: left;
    }

    img {
      border: 0;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    table {
      border-collapse: collapse !important;
    }

    td, th {
      text-align: left;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #464646;
      line-height:1.5em;
    }

    b a,
    .footer a {
      text-decoration: none;
      color: #464646;
    }

    a.blue-link {
      color: blue;
      text-decoration: underline;
    }

    /* ----- General ----- */

    td.center {
      text-align: center;
    }

    .left {
      text-align: left;
    }

    .body-padding {
      padding: 24px 40px 40px;
    }

    .border-bottom {
      border-bottom: 3px solid #00ad00;
    }

    table.full-width-gmail-android {
      width: 100% !important;
    }


    /* ----- Header ----- */
    .header {
      font-weight: bold;
      font-size: 16px;
      line-height: 16px;
      height: 16px;
      padding-top: 19px;
      padding-bottom: 7px;
    }

    .header a {
      color: #464646;
      text-decoration: none;
    }

    /* ----- Footer ----- */

    .footer a {
      font-size: 12px;
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 650px)">
    @media only screen and (max-width: 650px) {
      * {
        font-size: 16px !important;
      }

      table[class*="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"],
      div[class="mobile-center"] {
        text-align: center !important;
      }

      td[class*="body-padding"] {
        padding: 20px !important;
      }

      td[class="mobile"] {
        text-align: right;
        vertical-align: top;
      }
    }
  </style>

</head>
<body style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px !important;margin: 0 auto !important;padding: 20px !important;">
  <tr>
    <td valign="top" align="left" width="100%" style="">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td style="padding-bottom:20px;">
            Hallo {{$cname}}, <br>
            <br>
            Sie haben es fast geschafft, Bitte best??tigen Sie Ihre E-Mail,. <br>
            <br>
            <b>E-MAIL BESTATIGEN</b>
          </td>
        </tr>
      </table>

      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td class="left" style="padding-bottom:20px; text-align:left;">
            Diese Best??tigung erfolgt zu Ihrem Schulz Damit wollen wir sicherstellen, dass Sie sich pers??nlich <br>registriert haben und Ihre E-Mail-Adresse nicht unerlaubt von Dritten nenn. wuMe.
          </td>
        </tr>
      </table>
      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td class="left" style="padding-bottom:20px; text-align:left;">
            Wenn Sie diese E-Mail irrt??mlich erhalten haben, l??schen Sie diese einfach.<br>Wenn Sie den Best??tigungslink oben nicht anklicken, wiM Ihre E-Mail-Adresse nicht best??tigt und <br>der Registrierungsprozess abgebrochen.
          </td>
        </tr>
      </table>

      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td class="left" style="padding-bottom:40px; text-align:left;">
            Sollten SW noch Fragen haben, so nehmen Sie gem Kontakt zu uns auf: info@glv-makler.de
          </td>
        </tr>
        <tr>
          <td class="" style="padding-bottom:40px;">
            <p class="text-align: center;margin-top: 20px;margin-bottom: 30px;">
                <a style="color: #fff;
                   background: #00ad00;
                   text-decoration: none;
                   padding: 8px 18px;
                   border-radius: 0px;
                   font-size: 14px;
                   font-weight: bold;" href="{{$confirm_url}}">Verify Email address</a>
            </p>
          </td>
        </tr>
      </table>

      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td class="left" style="padding-bottom:10px;text-align:left;">
            Mit freundlichen Gr??Ben aus Hil
          </td>
        </tr>
        <tr>
          <td class="left" style="text-align:left;">
            Ihr Team von
          </td>
        </tr>
        <tr>
          <td class="left" style="padding-bottom:40px;text-align:left;">
            GLV Versicherungsmakler
          </td>
        </tr>
      </table>
      

      <table cellspacing="0" cellpadding="0" width="100%" style="display: inline-block;">
        <tr>
          <td style="">
            <b>Bleiben e mit uns in Verbindung</b>
          </td>
          <td style="padding-left: 35px;">
            <b style="font-style: italic;">Kooperationspartner</b>
          </td>
        </tr>
        <tr>
          <td class="border-bottom" height="5" style="width: 30%;padding-top: 10px;"></td>
          <td class="" style="width: 50%;"></td>
        </tr>
        <tr>
          <td style="padding-top:30px; vertical-align:top;">
            <img src="{{$logo1}}" originalsrc="{{$logo1}}" style="width: 70%;">
          </td>
          <td style="padding-left: 35px;padding-top:39px; vertical-align:top;">
            <img src="{{$logo2}}" originalsrc="{{$logo2}}" style="width: 34%;">
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
</body>
</html>