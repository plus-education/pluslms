<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            .activity-header, .comment-title{
                background: #193660;
                padding: 22px;
            }


            .activity-header h1, .comment-title h1{
                color: #fff;
                font-weight: bold;
                font-size: 2rem;
                text-align: center;
            }

            .editor-js-content p{
                border-left: solid 20px #FCBC19;
                padding: 0 17px;
            }

            .editor-js-content iframe{
                margin: auto
            }

            .editor-js-content ul li::before {
                content: "\2022";  /* Add content: \2022 is the CSS Code/unicode for a bullet */
                color: #193660; /* Change the color */
                font-weight: bold; /* If you want it to be bold */
                display: inline-block; /* Needed to add space between the bullet and the text */
                width: 2em; /* Also needed for space (tweak if needed) */
                margin-left: -1em; /* Also needed for space (tweak if needed) */
            }

            .editor-js-content{
                text-align: justify;
            }

            .editor-js-link{
                border: solid 1px #6666;
                padding: 13px;
                background: white;
                width: 75%;
                margin: auto;
            }

            .editor-js-content .editor-js-block{padding:.7em 0}.editor-js-content h2{padding:1em 0;margin:0 0 -.9em;line-height:1.5em}
            .editor-js-content p{line-height:1.6em}.editor-js-content li{padding:5.5px 0 5.5px 3px;line-height:1.6em}
            .editor-js-content .editor-js-code{min-height:200px;color:#41314e;line-height:1.6em;font-size:12px;background:#f8f7fa;border:1px solid #f1f1f4;box-shadow:none;white-space:pre;word-wrap:normal;overflow-x:auto;resize:vertical}.
                                                                                                                                                                                                                                            editor-js-content .editor-js-link{display:block;background:#fff;border:1px solid rgba(201,201,204,.48);box-shadow:0 1px 3px rgba(0,0,0,.1);border-radius:6px;padding:25px}
            .editor-js-content .editor-js-link h4{font-size:17px;font-weight:600;line-height:1.5em;margin:0 0 10px}.editor-js-content .editor-js-link small{margin-top:25px;display:block;font-size:15px;line-height:1em;color:#888}.editor-js-content .editor-js-link .editor-js-link-image{background-position:50%;background-repeat:no-repeat;background-size:cover;margin:0 0 0 30px;width:65px;height:65px;border-radius:3px;float:right}.editor-js-content .editor-js-checklist .checklist-item{display:flex;padding:0 10px;box-sizing:content-box}.editor-js-content .editor-js-checklist .checklist-item .checkbox{display:inline-block;flex-shrink:0;position:relative;width:20px;height:20px;margin:10px 10px 10px 0;border-radius:50%;border:1px solid #d0d0d0;background:#fff;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.editor-js-content .editor-js-checklist .checklist-item .checkbox:after{position:absolute;top:5px;left:5px;width:8px;height:5px;border:2px solid #fcfff4;border-top:none;border-right:none;background:transparent;content:"";opacity:1;transform:rotate(-45deg)}.editor-js-content .editor-js-checklist .checklist-item .checkbox-checked{background:#388ae5;border-color:#388ae5}.editor-js-content .editor-js-checklist .checklist-item .checkbox-text{outline:none;flex-grow:1;padding:10px 0}.editor-js-content .editor-js-delimiter{line-height:1.6em;width:100%;text-align:center}.editor-js-content .editor-js-delimiter:before{display:inline-block;content:"***";font-size:30px;line-height:65px;height:30px;letter-spacing:.2em}.editor-js-content .editor-js-table{width:100%;height:100%;border-collapse:collapse;table-layout:fixed}.editor-js-content .editor-js-table td{border:1px solid #dbdbe2;padding:10px;vertical-align:top}


	    .editor-js-image{
		    text-align: center;
	    }

	    .editor-js-image img{
		    display: initial;
        }

        </style>


        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
