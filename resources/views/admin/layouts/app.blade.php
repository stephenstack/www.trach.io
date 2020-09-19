<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="mobile-web-app-capable" content="yes">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <title>trach.io Admin Panel</title>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    {{-- https://ionicframework.com/docs/v3/ionicons/ --}}
    <link href="/css/app.css" rel="stylesheet">
    {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> --}}
    {{-- https://github.com/ecreeth/tailwind-admin --}}
    <style>
        svg {
            transition: all .3s ease;
        }

        #resourcemenu>div {
            transition: all .1s ease-in-out;
        }

        #resourcemenu:hover svg {
            transform: translateX(35px) rotate(180deg);
            opacity: 0;
        }

        div#resourcemenu:hover>div {
            visibility: visible;
        }

        #usermenu>div {
            transition: all .1s ease-in-out;
        }

        #usermenu:hover svg {
            transform: translateX(35px) rotate(180deg);
            opacity: 0;
        }

        #usermenu:hover>div {
            visibility: visible;
        }
    </style>
</head>

<body class="bg-gray-200" >
    <div class="font-sans m-0 antialiased leading-none">
        @yield('topnav')
        <!-- START NAV -->
        <nav class="bg-white border-b">
            <div class="container mx-auto">
                <div class="flex items-center justify-between py-4 pl-1">

                    <!-- LOGO -->
                    <div>
                        <a href="#" class="block flex items-center font-extrabold text-gray-700">
                            <img src="/images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-675_x_256.png"
                                class="h-10" alt="Logo"></a>
                    </div>

                    <!-- Header Menu -->
                    <div class="flex justify-end">
                        <div class="lg:flex lg:items-center lg:w-auto uppercase ">
                            <a href="/admin"
                                class="text-gray-800 text-sm hover:text-blue-600 mr-5 text-2xl lg:text-base @if(request()->is('admin')){{ 'font-semibold text-indigo-500' }}@endif">
                                <i
                                    class="icon ion-ios-analytics mr-2 text-gray-600 inline-block @if(request()->is('admin')){{ 'font-semibold text-indigo-500' }}@endif"></i>Dashboard
                            </a>
                        </div>

                        <div class="hidden sm:flex items-center">
                            <div class="relative" id="resourcemenu">
                                <div
                                    class="flex items-center cursor-pointer text-sm border border-white border-b-0 text-gray-700 rounded-t-lg py-1 px-2 uppercase  text-2xl lg:text-base">
                                    <i class="icon ion-ios-help-buoy mr-2"></i>Resources
                                    <svg class="fill-current text-gray-600 h-4 w-4 mt-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                                <div
                                    class="absolute border border-t-0 border-gray-100 invisible rounded-b-lg bg-white p-2 w-48 text-3xl lg:text-base">
                                    <a href="http://trachy.test" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Trach.io Dev Url</a>
                                    <a href="https://analytics.google.com/analytics/web/" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">GoogleAnaytics</a>
                                    <a href="https://www.larabug.com/dashboard" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Larabug</a>
                                    <a href="https://login.mailgun.com/login/" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Mailgun</a>
                                    <a href="https://mailtrap.io/inboxes" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Mailtrap</a>
                                    <a href="https://www.namecheap.com/myaccount/login/" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">NameCheap</a>
                                    <a href="https://ploi.io/panel" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Ploi</a>
                                    <a href="https://dashboard.stripe.com/" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Stripe</a>
                                    <a href="https://portal.azure.com/#@8ea02b48-ff5d-44f9-ac42-0678f1ed3472/dashboard/private/878ceb9b-8531-4c91-9065-b417bb37493d" target="_blank"
                                        class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Azure App Dashboard</a>
                                </div>
                            </div>
                        </div>

                        <div class="hidden sm:flex items-center">
                            <div class="relative" id="usermenu">
                                <div
                                    class="flex items-center cursor-pointer text-sm border border-white border-b-0 text-gray-700 rounded-t-lg py-1 px-2 uppercase text-2xl lg:text-base">
                                    <i class="icon ion-ios-person mr-2"></i>Account
                                    <svg class="fill-current text-gray-600 h-4 w-4 mt-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                                <div
                                    class="absolute border border-t-0 border-gray-100 invisible rounded-b-lg bg-white p-2 w-48  text-2xl lg:text-base">
                                    <a href="/dashboard" class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold ">Account
                                        Settings</a>
                                    <a href="/logout" class="px-4 py-2 mt-2 block text-gray-800 hover:font-semibold">Logout</a>
                                </div>
                            </div>
                        </div>
                    </!DOCTYPE>

                    <!-- Toggle Menu Svg Icon -->
                    <div class="block lg:hidden cursor-pointer h-6 w-6 mr-4 "  onclick="toggleMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="stroke-current text-purple inline-block h-8 w-8">
                            <path fillRule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </!DOCTYPE>

                </!DOCTYPE>
            </!DOCTYPE>
        </nav>
        <!-- END NAV -->

        <div class="container-fluid mx-10 ">
            <div class="flex min-w-full rounded-sm mt-4">
                <!-- ASIDE -->

                <div class="hidden lg:block w-1/4 md:w-2/6 mb-5" id="menu">
                    <!-- First Aside Menu -->
                    <div class="bg-white rounded">
                        <div class="border-b border-gray-200">
                            <div class="text-black uppercase text-sm py-5 px-5">Subscriptions</div>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/subscriptions">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/subscriptions')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-wallet mr-2 text-gray-600 inline-block "></i> <span class="text-3xl lg:text-lg">Subscriptions</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/incomplete-payments">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/incomplete-payments')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-wallet mr-2 text-gray-600 inline-block "></i> <span class="text-3xl lg:text-lg">Incomplete Payments</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Second Aside Menu -->
                    <div class="mt-5 bg-white rounded">
                        <div class="border-b border-gray-200">
                            <div class="text-black uppercase text-sm py-5 px-5">Users</div>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/users">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/users')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-people mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Registered Users</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/mailing_lists">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/subscribers')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-mail mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Mail Subscribers</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/announcements">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/announcements')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-megaphone mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Annoucements</span>
                                </div>
                            </a>
                        </div>
                        {{-- <div>
                            <a class="block py-3 px-5" href="/admin/tickets">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/tickets')){{ 'font-semibold text-indigo-500' }}@endif">
                                    @if($shareddata['openTicketsCount'])<span
                                        class="absolute pin-r pin-t -mt-2 ml-16 rounded-full bg-green-500 px-1 text-xs shadow text-white">{{$shareddata['openTicketsCount']}}</span>@endif
                                    <i class="icon ion-ios-chatbubbles mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Tickets</span>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                    <!-- Third Aside Menu -->

                    <div class="mt-5 bg-white rounded">
                        <div class="border-b border-gray-200">
                            <div class="text-black uppercase text-sm py-5 px-5">System</div>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/jobs">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/jobs')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-paper mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Current Jobs</span>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="block py-3 px-5" href="/admin/failed_jobs">
                                <div
                                    class="text-gray-700 hover:font-semibold @if(request()->is('admin/failed_jobs')){{ 'font-semibold text-indigo-500' }}@endif">
                                    <i class="icon ion-ios-paper mr-2 text-gray-600 inline-block"></i><span class="text-3xl lg:text-lg">Failed Jobs</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> <!-- END ASIDE -->

                <!-- CONTENT -->
                @yield('content')
                <!-- END MAIN CONTENT -->
            </div>
        </div>
    </div>
    <script>
        function toggleMenu(elem) {
            var element = document.getElementById("menu");
            element.classList.toggle("hidden");
        }
    </script>
</body>

</html>