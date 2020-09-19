<div class="w-full z-20">
    <!-- Nav Bar -->
    <nav class="font-sans text-center flex justify-between my-4 mx-auto container overflow-hidden mt-8 z-50 relative px-5">
        <a href="/" class="toggleColour text-gray-700 no-underline hover:no-underline font-bold text-2xl lg:text-4xl  mx-auto sm:mx-0">
            <img src="/images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-251_x_96.png" srcset="
                /images/logos/FullColor_Trans_IconOnly_1024x1024_72dpi-32_x_32.png 150w,
                /images/logos/FullColor_Trans_IconOnly_1024x1024_72dpi-48_x_48.png 320w,
                /images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-169_x_64.png 800w,
                /images/logos/FullColor_SideBySide_TransparentBg_2700_72dpi-251_x_96.png 1200w" sizes="(max-width: 600px)  200px, 50vw" class="h-full sm:object-scale-down" alt="trach.io Logo">
        </a>
        <ul class="text-sm text-grey-dark list-reset flex content-start">
            <li class="mt-1 mr-4 md:mr-8 ml-4 md:ml-0">
                <a href="/" class="font-semibold text-pink-500">Home</a>
            </li>
            <li class="mt-1 mr-4 md:mr-8">
                <a href="#features" class="font-semibold text-gray-900 hover:text-pink-500">Features</a>
            </li>
            <li class="mt-1 mr-4 md:mr-8">
                <a href="#pricing" class="font-semibold text-gray-900 hover:text-pink-500">Pricing</a>
            </li>

            @if (Auth::check())

            <li class="mt-1 mr-4 md:mr-8">
                |
            </li>
            <li class="mt-1 mr-4 md:mr-8">
                <a href="/app" class="font-semibold text-gray-900 hover:text-pink-500">App</a>
            </li>
            <li class="mt-1 mr-4 md:mr-8">
                <a href="/profile" class="font-semibold text-gray-900 hover:text-pink-500">Profile </a>
            </li>
            <li>
                <a href="/logout" class="text-white ml-4 py-2 px-6 rounded font-bold hidden sm:block bg-indigo-600 shadow hover:bg-indigo-700 hover:shadow-xl">Log out</a>
            </li>

            @else

            <li class="mt-1 mr-4 md:mr-8">
                <a href="/register" class="font-semibold text-gray-900 hover:text-pink-500 hidden sm:block">Sign up</a>
            </li>
            <li class="mt-1 mr-4 md:mr-8 block sm:hidden">
                <a href="/login" class="font-semibold text-gray-900 hover:text-pink-500">Login </a>
            </li>
            <li>
                <a href="/login" class="text-white ml-4 py-2 px-6 rounded font-bold hidden md:block bg-indigo-600 shadow hover:bg-indigo-700 hover:shadow-xl">Login</a>
            </li>
            @endif

        </ul>
    </nav>
</div>
