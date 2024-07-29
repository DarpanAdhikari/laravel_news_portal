<html>

<head>
    <style type="text/css">
        h4 {
            text-align: left;
        }

        @media screen {

            .headerLineTitle {
                width: 1.5in;
                display: inline-block;
                margin: 0in;
                margin-bottom: .0001pt;
                font-size: 11.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: bold;
            }

            .headerLineText {
                display: inline;
                margin: 0in;
                margin-bottom: .0001pt;
                font-size: 11.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: normal;
            }

            .pageHeader {
                font-size: 14.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: bold;
                visibility: hidden;
                display: none;
            }
        }

        @media print {
            .headerLineTitle {
                width: 1.5in;
                display: inline-block;
                margin: 0in;
                margin-bottom: .0001pt;
                font-size: 11.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: bold;
            }

            .headerLineText {
                display: inline;
                margin: 0in;
                margin-bottom: .0001pt;
                font-size: 11.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: normal;
            }

            .pageHeader {
                font-size: 14.0pt;
                font-family: "Calibri", "sans-serif";
                font-weight: bold;
                visibility: visible;
                display: block;
            }

        }
    </style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="x-apple-disable-message-reformatting">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $postType }} Post: {{ $postTitle }}</title>

<style>
    @media only screen and (min-width: 620px) {
        .u-row {
            width: 600px !important;
        }

        .u-row .u-col {
            vertical-align: top;
        }

        .u-row .u-col-50 {
            width: 300px !important;
        }

        .u-row .u-col-100 {
            width: 600px !important;
        }

    }

    @media (max-width: 620px) {
        .u-row-container {
            max-width: 100% !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .u-row .u-col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
        }

        .u-row {
            width: 100% !important;
        }

        .u-col {
            width: 100% !important;
        }

        .u-col>div {
            margin: 0 auto;
        }
    }

    body {
        margin: 0;
        padding: 0;
    }

    table,
    tr,
    td {
        vertical-align: top;
        border-collapse: collapse;
    }

    p {
        margin: 0;
    }

    .ie-container table,
    .mso-container table {
        table-layout: fixed;
    }

    * {
        line-height: inherit;
    }

    a[x-apple-data-detectors='true'] {
        color: inherit !important;
        text-decoration: none !important;
    }

    table,
    td {
        color: #000000;
    }

    #u_body a {
        color: #0000ee;
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        #u_content_button_3 .v-button-colors {
            color: #ffffff !important;
            background-color: #75b7ac !important;
        }

        #u_content_button_3 .v-button-colors:hover {
            color: #FFFFFF !important;
            background-color: #3AAEE0 !important;
        }

        #u_content_button_3 .v-padding {
            padding: 5px 7px !important;
        }

        #u_content_button_3 .v-border-radius {
            border-radius: 12px !important;
            -webkit-border-radius: 12px !important;
            -moz-border-radius: 12px !important;
        }
    }
</style>



<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">






<table id="u_body"
    style="border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;min-width:320px;Margin:0 auto;background-color:#f9f9f9;width:100%; border-radius: 12px;"
    cellpadding="0" cellspacing="0">
    <tbody>
        <tr style="vertical-align:top">
            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">




                <div class="u-row-container" style="padding:0px;background-color:#e7e7e7">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#ffffff">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent">



                            <div class="u-col u-col-100"
                                style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">

                                        <table style="font-family:sans-serif; background: #e7e7e7;" role="presentation"
                                            cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;text-align:center;"
                                                        align="left">
                                                        @foreach ($logoNameImageUrls as $imageUrl)
                                                            <img src="{{ asset($imageUrl) }}" height="50"
                                                                style="margin-left:auto;margin-right:auto;"
                                                                alt="logo">
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table style="font-family:sans-serif; border-top-left-radius: 12px; border-top-right-radius: 12px;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px 40px;font-family:sans-serif;"
                                                        align="left">

                                                        <div
                                                            style="font-family:arial,helvetica,sans-serif;font-size:11px;line-height:160%;text-align:left;word-wrap:break-word">
                                                            <h1>{{ $postTitle }}</h1>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="u-row-container"
                    style="padding:0px;;background-repeat:no-repeat;background-position:center top;background-color:#e7e7e7">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:transparent">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:#ffffff">



                            <div class="u-col u-col-100"
                                style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;font-family:sans-serif;"
                                                        align="left">

                                                        <table width="100%" cellpadding="0" cellspacing="0"
                                                            border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding-right:0px;padding-left:0px"
                                                                        align="center">

                                                                        <img align="center" border="0"
                                                                            src="{{ asset($image) }}"
                                                                            alt="{{ $postTitle }}" title="Image"
                                                                            style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 100%;">

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>







                <div class="u-row-container" style="padding:0px;background-color:#e7e7e7">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#ffffff">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent">



                            <div class="u-col u-col-100"
                                style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">

                                                        <div
                                                            style="font-size:14px;line-height:140%;text-align:left;word-wrap:break-word">
                                                            <p
                                                                style="font-size:14px;line-height:140%;text-align:center;margin:0px">
                                                            </p>
                                                            <p
                                                                style="font-size:14px;line-height:140%;text-align:center;margin:0px">
                                                            </p>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px 40px;font-family:sans-serif;"
                                                        align="left">

                                                        <div
                                                            style="font-size:14px;line-height:150%;text-align:left;word-wrap:break-word">
                                                            <p style="font-size:14px;line-height:150%;margin:0px"> </p>
                                                            <p style="font-size:14px;line-height:150%;margin:0px"><span
                                                                    style="font-family:Lato,sans-serif;font-size:18px;line-height:21px">{{ $metaData }}</span>
                                                            </p>
                                                            <p style="font-size:14px;line-height:150%;margin:0px"> </p>
                                                            <p style="font-size:14px;line-height:150%;margin:0px"> </p>
                                                            @if ($auth)
                                                                <div style="margin-top: 15px;">
                                                                    <p><strong style="font-weight: 900;">Tags:</strong>
                                                                        {{ $tags }}</p>
                                                                    <p><strong
                                                                            style="font-weight: 900;">Keywords:</strong>
                                                                        {{ $keywords }}</p>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table id="u_content_button_3" style="font-family:sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:5px 12px 6px 10px;font-family:sans-serif;" align="left">
                                                        <div align="center">
                                                            <a href="{{ url("/{$slug}") }}" target="_blank" class="btn" style="box-sizing:border-box;display:inline-block;text-decoration:none;text-align:center;color:#fff;background:linear-gradient(to right, #007bff, #00bfff);border-radius:25px;padding:10px 20px;font-weight:bold;text-transform:uppercase;box-shadow:0 2px 4px rgba(0, 0, 0, 0.2);transition:all 0.3s ease;">
                                                                <span class="v-padding" style="display:block;padding:7px 12px;line-height:120%"><span style="font-size:18px;line-height:21.6px">View Post</span></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>





                <div class="u-row-container" style="padding:0px;background-color:transparent">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:transparent">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent">



                            <div class="u-col u-col-100"
                                style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important;border-radius:0px">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent;border-radius:0px">

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">

                                                        <div align="center">
                                                            <div style="display:table;max-width:215px">




                                                                <table align="left" border="0" cellspacing="0"
                                                                    cellpadding="0" width="32" height="32"
                                                                    style="width:32px!important;height:32px!important;display:inline-block;border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;margin-right:22px">
                                                                    <tbody>
                                                                        <tr style="vertical-align:top">
                                                                            <td align="left" valign="middle"
                                                                                style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">
                                                                                <a href="{{ __('facebook') }}"
                                                                                    title="Facebook" target="_blank">
                                                                                    <img src="https://cdn.tools.unlayer.com/social/icons/circle/facebook.png"
                                                                                        alt="Facebook"
                                                                                        title="Facebook"
                                                                                        width="32"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>



                                                                <table align="left" border="0" cellspacing="0"
                                                                    cellpadding="0" width="32" height="32"
                                                                    style="width:32px!important;height:32px!important;display:inline-block;border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;margin-right:22px">
                                                                    <tbody>
                                                                        <tr style="vertical-align:top">
                                                                            <td align="left" valign="middle"
                                                                                style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">
                                                                                <a href="{{ __('twitter') }}"
                                                                                    title="Twitter" target="_blank">
                                                                                    <img src="https://cdn.tools.unlayer.com/social/icons/circle/x.png"
                                                                                        alt="X" title="X"
                                                                                        width="32"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>



                                                                <table align="left" border="0" cellspacing="0"
                                                                    cellpadding="0" width="32" height="32"
                                                                    style="width:32px!important;height:32px!important;display:inline-block;border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;margin-right:22px">
                                                                    <tbody>
                                                                        <tr style="vertical-align:top">
                                                                            <td align="left" valign="middle"
                                                                                style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">
                                                                                <a href="{{ __('instagram') }}"
                                                                                    title="Instagram" target="_blank">
                                                                                    <img src="https://cdn.tools.unlayer.com/social/icons/circle/instagram.png"
                                                                                        alt="Instagram"
                                                                                        title="Instagram"
                                                                                        width="32"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>



                                                                <table align="left" border="0" cellspacing="0"
                                                                    cellpadding="0" width="32" height="32"
                                                                    style="width:32px!important;height:32px!important;display:inline-block;border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;margin-right:0px">
                                                                    <tbody>
                                                                        <tr style="vertical-align:top">
                                                                            <td align="left" valign="middle"
                                                                                style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">
                                                                                <a href="{{ __('youtube') }}"
                                                                                    title="YouTube" target="_blank">
                                                                                    <img src="https://cdn.tools.unlayer.com/social/icons/circle/youtube.png"
                                                                                        alt="YouTube" title="YouTube"
                                                                                        width="32"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>




                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>





                <div class="u-row-container" style="padding:0px;background-color:transparent">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:transparent">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent">



                            <div class="u-col u-col-50"
                                style="max-width:320px;min-width:300px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important;border-radius:0px">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent;border-radius:0px">

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">

                                                        <div
                                                            style="font-size:14px;line-height:140%;text-align:left;word-wrap:break-word">
                                                            @for ($i = 0; $i < count(__('aboutSiteOwner')['title']); $i++)
                                                                <p style="line-height:140%;margin:0px">
                                                                    <strong>{{ __('aboutSiteOwner')['title'][$i] }}</strong>:
                                                                    <span
                                                                        style="color:#95a5a6;line-height:19.6px">{{ __('aboutSiteOwner')['data'][$i] }}</span>
                                                                </p>
                                                            @endfor
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                            <div class="u-col u-col-50"
                                style="max-width:320px;min-width:300px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important;border-radius:0px">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent;border-radius:0px">

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">
                                                        <div style="width:100%;text-align:center"><a
                                                                href="{{ route('terms.show') }}"
                                                                style="color:#a09999;font-size:undefined">Terms of
                                                                Use</a></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">
                                                        <div style="width:100%;text-align:center"><a
                                                                href="{{ route('policy.show') }}"
                                                                style="color:#a09999;font-size:undefined">Privacy
                                                                Policy</a></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>





                <div class="u-row-container" style="padding:0px;background-color:#e7e7e7">
                    <div class="u-row"
                        style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#e7e7e7">
                        <div
                            style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent">



                            <div class="u-col u-col-100"
                                style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="height:100%;width:100%!important">
                                    <div
                                        style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                                        @if (!$auth)
                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0"
                                            cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif;"
                                                        align="left">

                                                        <div
                                                            style="font-size:14px;line-height:140%;text-align:left;word-wrap:break-word">
                                                            <p style="line-height:140%;margin:0px">You are receiving
                                                                this email because you subscribed to our newsletters. If
                                                                you wish to unsubscribe, click the button. <a
                                                                    href="{{ url("unsubscribe/{$email}") }}"
                                                                    style="cursor: pointer; background: transparent; text-decoration: none; -webkit-text-stroke: 1px #000;"
                                                                    class="unsubscribe-btn">Unsubscribe</a> </p>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="u-row-container" style="padding:0px;background-color:transparent">
                    <div class="u-row" style="margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:transparent">
                        <div style="border-collapse:collapse;display:table;width:100%;height:100%;background-color:transparent background: #e7e7e7;">
                            <div class="u-col u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                                <div style="background-color:#fcf9f9;height:100%;width:100%!important;border-radius:0px">
                                    <div style="box-sizing:border-box;height:100%;padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent;border-radius:0px">
                                        <table style="font-family:sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="word-break:break-word;padding:10px;font-family:sans-serif; width: 100%;text-align:center;" align="center">
                                                        <div style="font-family:andale mono,times;font-size:14px;font-weight:400;line-height:140%;text-align:center;word-wrap:break-word;">
                                                            <p style="line-height:140%;margin:0px; text-align: center">&copy; {{ date('Y') }} <a href="{{url('/')}}">{{ request()->getHost() }}</a> {{ __('copy-right') }}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>
</body>

</html>
