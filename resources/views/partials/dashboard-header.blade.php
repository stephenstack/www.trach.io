<header class="px-6 bg-white flex flex-wrap items-center lg:py-1 py-3 overflow-hidden">
    <div class="flex-1 flex justify-between items-center font-black text-gray-700">
        <a href="/"><img src="/images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-187_x_72.png" alt="trach.io logo" class="h-12"></a>
    </div>
    <label for="menu-toggle" class="cursor-pointer lg:hidden block">
        <svg class="fill-current text-gray-600 hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" </path>
        </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />
    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
        <nav>
            <ul class="lg:flex items-center justify-between text-sm font-medium text-gray-700 pt-4 lg:pt-0">
                <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent @if(Request::is('app')){{ 'border-pink-500 text-pink-500 font-bold' }}@else{{ 'text-gray-600 hover:text-gray-900' }}@endif" href="/app">Dashboard</a></li>
                <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent @if(Request::is('users')){{ 'border-pink-500 text-pink-500 font-bold' }}@else{{ 'text-gray-600 hover:text-gray-900' }}@endif" href="/team">Users</a></li>
                <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent @if(Request::is('support')){{ 'border-pink-500 text-pink-500 font-bold' }}@else{{ 'text-gray-600 hover:text-gray-900' }}@endif lg:mb-0 mb-2" href="/support">Support</a></li>
            </ul>
        </nav>
        <a href="#" class="group lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor border-l border-gray-300 pl-6" id="userdropdown">
            <p class="flex pr-2 text-gray-700 text-right ignore-body-click">{{ auth()->user()->name }}<br>
                <svg viewBox="0 0 320 512" class="text-gray-600 ml-2 inline-block h-6 ignore-body-click">
                    <path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z" />
                </svg>
            </p>
            <p><i class="fas fa-angle-down text-gray-600 ml-2 ignore-body-click"></i></p>
        </a>
        <div id="usermenu" class="absolute lg:mt-18 lg:mr-6 pt-1 z-40 left-0 lg:left-auto lg:right-0 lg:top-0 invisible lg:w-auto w-full">
            <div class="bg-white shadow-xl rounded rounded-t-none">
                <ul>
                    <li onclick="location.href='/app';" class="menuaccent flex items-center py-2 px-4 border-b group hover:bg-blue-500 cursor-pointer ">
                        <svg class="fill-current text-gray-800 h-8 w-8 mt-2 group-hover:text-white" viewBox="0 0 100 125">
                            <circle cx="50.00002" cy="27.55556" r="19.97233" transform="translate(-4.84006 43.42619) rotate(-45)" />
                            <path d="M7.76416,92.41675H92.23584a2.74368,2.74368,0,0,0,2.753-2.95624C93.19592,69.87421,73.73871,54.451,50,54.451S6.80408,69.87421,5.01123,89.46051A2.7436,2.7436,0,0,0,7.76416,92.41675Z" />
                        </svg>
                        <a href="/app" class="mt-1 pb-1 px-4 block text-gray-800 ignore-body-click group-hover:text-white">App Dashboard</a>
                    </li>
                    <li onclick="location.href='/logout';" class="flex items-center py-2 px-4 border-b group hover:bg-blue-500 cursor-pointer">
                        <svg class="fill-current text-gray-800 h-10 w-10 pr-2 group-hover:text-white" viewBox="0 0 77 100">
                            <g>
                                <g>
                                    <path d="M37,43 C39.209139,43 41,44.790861 41,47 C41,49.209139 39.209139,51 37,51 L35.9970707,51 C34.8947455,51 34,51.8951365 34,52.9992205 L34,68.0007795 C34,69.1046129 34.8954573,70 35.9992205,70 L64.0007795,70 C65.1046129,70 66,69.1045427 66,68.0007795 L66,52.9992205 C66,51.8953811 65.1047972,51 64.0029293,51 L63,51 C60.790861,51 59,49.209139 59,47 C59,44.790861 60.790861,43 63,43 L64.0029293,43 C69.5234318,43 74,47.4774596 74,52.9992205 L74,68.0007795 C74,73.5226802 69.5230314,78 64.0007795,78 L35.9992205,78 C30.4773198,78 26,73.5230314 26,68.0007795 L26,52.9992205 C26,47.4776407 30.475685,43 35.9970707,43 L37,43 Z M52.4231712,23.0105078 L61.7609222,32.1796472 C65.5183877,35.9505572 59.8816913,41.6074221 56.1242259,37.8365121 C54.9301603,36.6236277 53.9861417,37.010179 53.9861417,38.6698732 L53.9978947,61.0000006 L53.9999994,60.9999994 C54.0011622,63.2091381 52.211244,65.0009415 50.0021053,65.0021042 C50.0014035,65.0021046 50.0007018,65.0021048 50,65.0021048 L50,65 L50,65.002256 C47.790861,65.002256 46,63.211395 46,61.002256 C46,61.0015038 46.0000002,61.0007516 46.0000006,60.9999994 L46.0148547,38.6698732 C46.0148547,37.0133583 45.0737784,36.6201938 43.9129019,37.7988168 C40.1183087,41.6074221 34.4816123,35.9505572 38.2390778,32.1796472 L47.4492517,23.0247054 C48.8179934,21.6641718 51.0452464,21.6574641 52.4231712,23.0105078 Z" transform="translate(50.000000, 50.000000) rotate(-270.000000) translate(-50.000000, -50.000000) " />
                                </g>
                            </g>
                        </svg>
                        <a href="/logout" class="px-2 block text-gray-800 ignore-body-click group-hover:text-white">Logout</a>
                    </li>
                    <li class="flex items-center py-3 px-6 border-b bg-gray-200 ">
                        <span class="block ignore-body-click" :class="this.$planName === 'Trial' ? 'text-teal-700' :' text-indigo-600'">
                            @if(auth()->user()->onTrial())
                            <span class="text-xs text-teal-500 ignore-body-click">Trial Plan</span>
                            @else
                            <span class="font-semibold text-xs text-indigo-600 ignore-body-click">{{ ucfirst(auth()->user()->plan->name) }}
                                Plan</span>
                            @endif
                            <span> - <a class="text-sm text-indigo-500 hover:text-indigo-400" href="/profile/billing">Upgrade</a></span></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
@if ($errors->any())
<div class="container mx-auto max-w-3xl mt-8">
    <div class="bg-red-500 text-white p-4 rounded-lg">
        <p class="font-bold">Please fix the following errors</p>
        <ul class="list-disc ml-8">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if (session('alert'))
<div class="container mx-auto max-w-3xl mt-8">
    @php $alert_type = session('alert_type'); @endphp
    <div class="@if($alert_type == 'info'){{ 'bg-blue-400' }}@elseif($alert_type == 'success'){{ 'bg-green-400' }}@elseif($alert_type == 'error'){{ 'bg-red-400' }}@elseif($alert_type == 'warning'){{ 'bg-orange-400' }}@endif text-white p-4 rounded-lg" role="alert">
        <p class="font-bold">{{ ucfirst(session('alert_type')) }}</p>
        <p>{{ session('alert') }}</p>
    </div>
</div>
@endif
