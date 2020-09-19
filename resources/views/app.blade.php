<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="Tracheostomy patient monitoring app to record interventions and give data driven insights for carers and familys." />
    <meta name="keywords" content="Tracheostomy, restricted airways, chronic lung disease, tracheostomy tube, trachea, stoma, respiratory, ventilator, nebulizer, Tracheotomy, suction, Passy-Muir, Laryngoscopy, hse, nhs, medical, healthcare, nurse, homecare, agency nurse, Pneumonia, Artificial respiration" />
    <meta name="robots" content="index,follow" />

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta name="image" property="og:image" content="/images/screenshots/homepage.png">
    <meta name="author" content="Stephen Stack - Trach.io">


    <link href="/css/app.css" rel="stylesheet">
    <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <title>@yield('title')</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156055830-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-156055830-2');
    </script>

    <style>
        .gradient {
            background: linear-gradient(45deg, #667eea, #ed64a6);
        }
    </style>
</head>

<body class="antialiased bg-gray-200">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56VJRTG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @yield('content')

    @yield('javascript')

    <script>

        var userDropDownVisible = false;

        document.body.addEventListener("click", function (e) {
            if (e.target.id != "usermenu" && !e.target.classList.contains('ignore-body-click') && userDropDownVisible) {
                document.getElementById('usermenu').classList.add('invisible');
                userDropDownVisible = false;
            }
        });

        if(document.getElementById('userdropdown')){
            document.getElementById('userdropdown').addEventListener('click', function () {
                if (document.getElementById('usermenu').classList.contains('invisible')) {
                    document.getElementById('usermenu').classList.remove('invisible');
                    userDropDownVisible = true;
                } else {
                    document.getElementById('usermenu').classList.add('invisible');
                    userDropDownVisible = false;
                }
            });
        }

        (function() {
            if (!localStorage.getItem('trachio-cookieconsent')) {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(request.responseText);
                        var eu_country_codes = ['AL','AD','AM','AT','BY','BE','BA','BG','CH','CY','CZ','DE','DK','EE','ES','FO','FI','FR','GB','GE','GI','GR','HU','HR','IE','IS','IT','LT','LU','LV','MC','MK','MT','NO','NL','PO','PT','RO','RU','SE','SI','SK','SM','TR','UA','VA'];
                        if (eu_country_codes.indexOf(data.country_code) != -1) {
                            document.body.innerHTML += '\
                            <div class="trachio-cookieconsent" style="position:fixed;padding:20px;left:0;bottom:0;background-color:#000;color:#FFF;text-align:center;width:100%;z-index:99999;">\
                                This site uses cookies. By continuing to use this website, you agree to their use. \
                                <a href="#" class="text-gray-100 hover:text-gray-400 ml-4">I Understand</a>\
                            </div>\
                            ';
                            document.querySelector('.trachio-cookieconsent a').onclick = function(e) {
                                e.preventDefault();
                                document.querySelector('.trachio-cookieconsent').style.display = 'none';
                                localStorage.setItem('trachio-cookieconsent', true);
                            };
                        }
                    }
                };
                request.open('GET', 'https://ipapi.co/json', true);
                request.send();
            }
        })();
    </script>
</body>

</html>