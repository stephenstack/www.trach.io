@extends('app')

@section('title', 'trach.io - Tracheostomy patient monitoring app for your loved ones!')

@section('content')

@include('partials.nav')

<!-- Hero Section -->
<section class="font-sans container m-auto flex px-5">

    <div class="flex-1 flex items-start flex-col justify-center">
        <h1 class="my-4 font-medium mt-8 lg:mt-32 text-center w-full px-2 text-gray-800 text-2xl xl:text-3xl lg:px-0 font-black mb-12 md:w-full lg:text-left lg:-mt-4 h-auto xl:h-24">
            Tracheostomy patient monitoring app <span id="title" class="text-pink-500"></span></h1>
        <p class="leading-normal mb-12 pr-36 text-normal xl:text-lg text-center w-full px-16 text-gray-600 leading-loose xl:pr-32 md:text-center md:px-32 sm:text-center lg:text-left lg:px-0">
            We want the care of your loved ones with trachys to be monitored, data driven and of the highest quality.
            <strong>Trach.io</strong> helps you build confidence in the care given, and interventions adminisitered. <br>
            <small class="text-sm text-gray-500 italic">pronounced "trackyˈo"</small>
        </p>
        <form class="block sm:flex w-full px-0 sm:px-16 xl:pr-32 lg:pr-16 md:px-32 lg:px-0" action="/mailing-list-subscribe" method="post" id="embedded-subscribe-form" name="embedded-subscribe-form" novalidate="">
            @csrf
            <input class="bg-white border-2 border-gray-300 rounded py-2 px-4 block w-full focus:outline-none focus:border-indigo-600 text-black input" id="email" type="email" name="email" autofocus="" placeholder="jane@example.com">
            <button class="hover:bg-grey-darker text-white ml-0 sm:ml-4 py-2 px-6 rounded bg-indigo-600 font-bold w-full sm:w-2/3 mt-4 sm:mt-0">Submit</button>
        </form>
        @if (session('mailerrormsg'))
        <div class="text-red-500 text-sm mt-2">{{session('mailerrormsg')}}</div>
        @endif
        @if (session('mailsuccess'))
        <div class="text-green-600 text-sm mt-2">{{session('mailsuccess')}}</div>
        @endif
        <div class="mt-4 flex text-sm border border-gray-200 rounded-full p-2 text-pink-500 text-sm mx-auto lg:mx-0 mb-8 lg:mb-0">
            <span class="bg-pink-500 text-white rounded-full px-3 h-6 flex items-center xl:inline">Signup</span>
            <span class="px-2 flex items-center">for progress updates and gain early access when we release!</span>
        </div>
    </div>
    <div class="flex-1 hidden items-start flex-col justify-center lg:flex relative pl-16">
        <img src="/images/nurse_hero.png" class="w-full object-cover relative bottom-0 z-10 mt-32 mr-8" style="width:580px;height:680px;" alt="tracj.io nurse hero">
    </div>
</section>

<!-- Screenshots Section -->
<div class="bg-gray-100">
    <div class="container mx-auto mt-0 pb-4 md:pb-16 pt-4 ">
        <h2 class="w-full text-2xl sm:text-4xl font-bold text-left text-indigo-500 uppercase h-8 md:h-20"></h2>
        <div class="flex flex-wrap justify-center ">
            <div class="container mx-auto w-full lg:w-3/4 h-full px-8 md:px-16">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <img src="images/screenshots/main_screen_shot.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="images/screenshots/report_screen_shot.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                    <img src="images/screenshots/notes_screen_shot.png" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="images/screenshots/event_screen_shot.png" style="width:100%">
                </div>

                <div class="mt-4" style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
            </div>

            <div class="w-full md:w-1/4 py-6 md:py-0 flex flex-col justify-center px-8 sm:px-16 ">
                <h3 class="text-xl lg:text-3xl font-bold leading-none mb-3 mt-16 text-gray-700 -mt-1">An industry first</h3>
                <p class="text-gray-600 text-sm text-justify">Tracheostomy care app that enables logging and retrieval of accurate and real time care data for your patient with
                    Tracheostomy needs.</p>
                <a href="#features" class="font-semibold text-gray-900 hover:text-pink-500 mt-2">View features</a>
            </div>
        </div>
    </div>
</div>


<!-- Features Section -->
<section class="bg-gray-200">
    <a name="features"></a>
    <div class="container mx-auto mt-0 pb-4 md:pb-24 px-8 sm:px-16 ">
        <h2 class="w-full pt-8 sm:pt-16 pt-4 text-2xl sm:text-4xl font-bold text-left text-indigo-500 uppercase">Our
            Features</h2>
        <p class="w-full mb-8 md:mb-16 text-xl text-gray-700">trach.io was built by parents, for parents and carers.</p>

        <div class="flex flex-wrap md:flex-no-wrap lg:flex-row w-full mt-4 md:mt-16 ">

             <div class="w/full md:w-1/3 mx-4 bg-white rounded shadow-lg flex flex-wrap items-center justify-center p-8">
                <svg viewBox="0 0 24 30" class="fill-current text-blue-500 h-20">
                <path d="M23.516 1.098H.485a.4.4 0 00-.4.4v16.767a.4.4 0 00.4.4H9.48v3.437H8.407a.4.4 0 000 .8h7.186a.4.4 0 000-.8h-1.072v-3.437h8.995a.4.4 0 00.4-.4V1.498a.4.4 0 00-.4-.4zM.885 8.776h2.359a.4.4 0 00.37-.248l1.083-2.623 1.041 5.546a.4.4 0 00.354.324.392.392 0 00.41-.248L7.69 8.59h1.205a.4.4 0 00.367-.241l1.034-2.387.29 2.038a.399.399 0 00.707.194l1.204-1.493.682 4.735a.398.398 0 00.396.343.4.4 0 00.338-.186l1.9-3.007h1.819c.18 0 .337-.119.385-.292l.704-2.514 1.021 2.67a.4.4 0 00.374.257h2.998v5.533H.885V8.776zm22.23-6.878v6.009h-2.723l-1.355-3.543a.406.406 0 00-.393-.256.398.398 0 00-.366.292l-.949 3.387h-1.736a.398.398 0 00-.338.186l-1.438 2.276-.658-4.569a.4.4 0 00-.707-.194l-1.204 1.492-.361-2.526a.4.4 0 00-.763-.103L8.631 7.792H7.419a.4.4 0 00-.371.25l-.777 1.921-1.038-5.53a.398.398 0 00-.762-.078L2.976 7.977H.885V1.898h22.23zM13.72 22.102h-3.44v-3.437h3.44v3.437zM.885 17.864v-2.823h22.23v2.823H.885z"/>
                <path d="M4.165 15.96H2.322a.4.4 0 000 .8h1.842a.4.4 0 00.001-.8z"/>
                </svg>
                <p class="w-full text-blue-800 font-semibold text-2xl text-center mb-4">Track Interventions</h3>
                <p class="w-full text-blue-800 mx-4">
                    Record interventions such as suctioning, O2 and desat events accuratley, without affecting patient care. Get alerts when care falls behind expectations.
                </p>
            </div>

            <div class="w/full md:w-1/3 mx-4 bg-white rounded shadow-lg flex flex-wrap items-center justify-center p-8 mt-4 md:mt-0">
                <svg viewBox="0 0 32 40" class="fill-current text-blue-500 h-20">
                <g data-name="Layer 17">
                    <path d="M27 31H5a1 1 0 01-1-1V2a1 1 0 011-1h4a1 1 0 010 2H6v26h20V3h-3a1 1 0 010-2h4a1 1 0 011 1v28a1 1 0 01-1 1z"/>
                    <path d="M20 7h-8a1 1 0 01-1-1V2a1 1 0 011-1h8a1 1 0 011 1v4a1 1 0 01-1 1zm-7-2h6V3h-6zM22 16h-2.38l-1.73-3.45a1 1 0 00-.12-.16.8.8 0 00-.13-.13l-.15-.09a1.76 1.76 0 00-.2-.09h-.35l-.17.05a.42.42 0 00-.15 0 .83.83 0 00-.15.11l-.14.14a1.19 1.19 0 00-.09.15 1.76 1.76 0 00-.09.2l-1.21 5.48-.94-2.53a1.18 1.18 0 00-.11-.19.71.71 0 00-.1-.14.49.49 0 00-.14-.11.5.5 0 00-.17-.11.66.66 0 00-.15 0A.85.85 0 0013 15H9a1 1 0 000 2h3.28l1.77 5.32c0 .05 0 .09.07.14l.06.1a.82.82 0 00.24.25 1 1 0 00.33.14L15 23a1.25 1.25 0 00.32-.05.92.92 0 00.32-.18l.08-.08a1 1 0 00.15-.2s0-.08.05-.13a.52.52 0 00.06-.13L17.37 16l.74 1.48a1 1 0 00.17.25.78.78 0 00.24.16h.09A1 1 0 0019 18h3a1 1 0 000-2z"/>
                </g>
                </svg>
                <p class="w-full text-blue-800 font-semibold text-2xl text-center mb-4">View Care History</h3>
                <p class="w-full text-blue-800 mx-4">
                    Understand current patient needs by viewing recent events. Review long term patient care history to aid in accurate clinical decision making.
                </p>
            </div>

            <div class="w/full md:w-1/3 mx-4 bg-white rounded shadow-lg flex flex-wrap items-center justify-center p-8 mt-4 md:mt-0">
                <svg viewBox="0 0 100 125" class="fill-current text-blue-500 h-20">
                <switch>
                    <g i:extraneous="self">
                    <path d="M86.8 49.5l-.6.6v31.1c0 2.6-2.2 4.8-4.8 4.8H18.7c-2.7 0-4.8-2.2-4.8-4.8v-2.7c-.9.2-1.8.3-2.8.3-1 0-2-.1-2.9-.3v2.7c0 5.8 4.7 10.5 10.5 10.5h62.6c5.8 0 10.5-4.7 10.5-10.5V49.4c-.9.2-1.9.3-2.9.3-.7 0-1.5 0-2.1-.2zM13.9 50.6V18.7c0-2.7 2.1-4.8 4.8-4.8h62.6c2.6 0 4.8 2.1 4.8 4.8v2.7c.9-.2 1.8-.3 2.8-.3 1 0 2 .1 2.9.3v-2.7c0-5.8-4.7-10.5-10.5-10.5H18.7c-5.8 0-10.5 4.7-10.5 10.5v31.9c.9-.2 1.9-.3 2.9-.3.9 0 1.9 0 2.8.3z"/>
                    <path d="M88.9 26.8c-4.7 0-8.6 3.9-8.6 8.6 0 1.3.3 2.5.8 3.6L66.7 53.1c-1.1-.6-2.4-.9-3.8-.9-2.1 0-4 .8-5.5 2.1l-12-6.9c.1-.5.2-1 .2-1.6 0-4.7-3.9-8.6-8.6-8.6s-8.6 3.9-8.6 8.6c0 .8.2 1.6.4 2.4L16 57.5c-1.4-1-3.1-1.5-4.9-1.5-4.7 0-8.6 3.9-8.6 8.6 0 4.7 3.9 8.6 8.6 8.6s8.6-3.9 8.6-8.6c0-.8-.2-1.6-.4-2.4l12.9-9.3c1.4 1 3.1 1.5 4.9 1.5 2.1 0 4-.8 5.5-2.1l12 6.9c-.1.5-.2 1-.2 1.6 0 4.7 3.9 8.6 8.6 8.6s8.6-3.9 8.6-8.6c0-1.3-.3-2.5-.8-3.6l14.4-14.1c1.1.6 2.4.9 3.8.9 4.7 0 8.6-3.9 8.6-8.6s-4-8.6-8.7-8.6zM11.1 67.4c-1.6 0-2.9-1.3-2.9-2.9 0-1.6 1.3-2.9 2.9-2.9s2.9 1.4 2.9 3-1.3 2.8-2.9 2.8zM37 48.7c-1.6 0-2.9-1.3-2.9-2.9 0-1.6 1.3-2.9 2.9-2.9s2.9 1.3 2.9 2.9c0 1.6-1.3 2.9-2.9 2.9zm26 15c-1.6 0-2.9-1.3-2.9-2.9 0-1.6 1.3-2.9 2.9-2.9 1.6 0 2.9 1.3 2.9 2.9-.1 1.6-1.3 2.9-2.9 2.9zm25.9-25.4c-1.6 0-2.9-1.3-2.9-2.9 0-1.6 1.3-2.9 2.9-2.9s2.9 1.3 2.9 2.9c0 1.6-1.3 2.9-2.9 2.9z"/>
                    </g>
                </switch>
                </svg>
                <p class="w-full text-blue-800 font-semibold text-2xl text-center mb-4">Tracheostomy Care Insights</h3>
                <p class="w-full text-blue-800 mx-4">
                    Gather holistical environment and ancilliary patient care data to help determine patterns and makre tactical and strategic decisions on patient care.
                </p>
            </div>
        </div>
        {{-- <div class="flex justify-center  w-full"><a href="register" class="text-4xl font-semibold text-gray-900 hover:text-pink-500 mt-8">Sign up</a></div> --}}
    </div>

</section>

<section>
    <a name="pricing"></a>
    <div class="w-full bg-indigo-700 text-center pb-40 pt-12 ">
        <h4 class=" font-bold text-3xl text-white sm:text-5xl" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.9s cubic-bezier(0.5, 0, 0, 1) 0s, transform 0.9s cubic-bezier(0.5, 0, 0, 1) 0s;">
            Simple Pricing Plans</h4>
        <h5 class=" font-light text-xl text-blue-200 sm:text-2xl" style="visibility: visible; opacity: 1; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); transition: opacity 0.9s cubic-bezier(0.5, 0, 0, 1) 0s, transform 0.9s cubic-bezier(0.5, 0, 0, 1) 0s;">
            Always know what you’ll pay.</h5>
    </div>

    <div class="flex flex-wrap items-center justify-center -mt-32 w-full mb-8 md:mb-20 ">

        <div class="rounded-t sm:rounded sm:shadow-lg sm:z-10 w-full md:w-2/5 mx-8 md:mx-0">
            <div class="bg-gray-300 font-bold px-10 py-6 rounded-t text-blue-700 uppercase">
                Pricing Plans
            </div>
            <div class="bg-white p-6 text-sm sm:pb-10 sm:pt-8 sm:px-10 sm:rounded-b-md sm:text-xs md:text-sm">
                <p class="mb-4 text-blue-800">trach.io has a simple pricing stucture and is based on the amount of data that can be stored on our cloud based systems.</p> <span class="block mb-8 text-blue-800">All of our
                    plans
                    include:</span>
                <ol class="list-reset">
                    <li class="flex items-center mb-6">
                        <div class="leading-none mr-4"><svg class="fill-current" width="18px" height="20px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 20">
                                <g transform="translate(-299.000000, -1688.000000)">
                                    <g transform="translate(250.000000, 1468.000000)">
                                        <path d="M57,232.585786 L57,221 C57,220.447715 57.4477153,220 58,220 C58.5522847,220 59,220.447715 59,221 L59,232.585786 L62.2928932,229.292893 C62.6834175,228.902369 63.3165825,228.902369 63.7071068,229.292893 C64.0976311,229.683418 64.0976311,230.316582 63.7071068,230.707107 L58.7071068,235.707107 C58.3165825,236.097631 57.6834175,236.097631 57.2928932,235.707107 L52.2928932,230.707107 C51.9023689,230.316582 51.9023689,229.683418 52.2928932,229.292893 C52.6834175,228.902369 53.3165825,228.902369 53.7071068,229.292893 L57,232.585786 Z M49,235 C49,234.447715 49.4477153,234 50,234 C50.5522847,234 51,234.447715 51,235 L51,238 L65,238 L65,235 C65,234.447715 65.4477153,234 66,234 C66.5522847,234 67,234.447715 67,235 L67,238 C67,239.104569 66.1045695,240 65,240 L51,240 C49.8954305,240 49,239.104569 49,238 L49,235 Z">
                                        </path>
                                    </g>
                                </g>
                            </svg> </div> <span class="font-bold text-blue-darker">Record unlimited interventions</span>
                    </li>
                    <li class="flex items-center mb-6">
                        <div class="leading-none mr-4"><svg class="fill-current" width="20px" height="16px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 16">
                                <g transform="translate(-298.000000, -1732.000000)" fill-rule="nonzero">
                                    <g transform="translate(250.000000, 1468.000000)">
                                        <path d="M50,264 L66,264 C67.1045695,264 68,264.895431 68,266 L68,278 C68,279.104569 67.1045695,280 66,280 L50,280 C48.8954305,280 48,279.104569 48,278 L48,266 C48,264.895431 48.8954305,264 50,264 Z M66,267.283886 L66,266 L50,266 L50,267.283886 L58,271 L66,267.283886 Z M66,270 L58.4472136,273.604303 C58.1656861,273.738652 57.8343139,273.738652 57.5527864,273.604303 L50,270 L50,278 L66,278 L66,270 Z" id="Combined-Shape"></path>
                                    </g>
                                </g>
                            </svg> </div> <span class="font-bold text-blue-darker">Alerts & Notifications</span>
                    </li>
                    <li class="flex items-center mb-6">
                        <div class="leading-none mr-4">
                            <svg viewBox="0 0 32 30" class="fill-current text-gray-800 h-6 -ml-1">
                                <g data-name="Layer 17">
                                    <path d="M27 31H5a1 1 0 01-1-1V2a1 1 0 011-1h4a1 1 0 010 2H6v26h20V3h-3a1 1 0 010-2h4a1 1 0 011 1v28a1 1 0 01-1 1z" />
                                    <path d="M20 7h-8a1 1 0 01-1-1V2a1 1 0 011-1h8a1 1 0 011 1v4a1 1 0 01-1 1zm-7-2h6V3h-6zM22 16h-2.38l-1.73-3.45a1 1 0 00-.12-.16.8.8 0 00-.13-.13l-.15-.09a1.76 1.76 0 00-.2-.09h-.35l-.17.05a.42.42 0 00-.15 0 .83.83 0 00-.15.11l-.14.14a1.19 1.19 0 00-.09.15 1.76 1.76 0 00-.09.2l-1.21 5.48-.94-2.53a1.18 1.18 0 00-.11-.19.71.71 0 00-.1-.14.49.49 0 00-.14-.11.5.5 0 00-.17-.11.66.66 0 00-.15 0A.85.85 0 0013 15H9a1 1 0 000 2h3.28l1.77 5.32c0 .05 0 .09.07.14l.06.1a.82.82 0 00.24.25 1 1 0 00.33.14L15 23a1.25 1.25 0 00.32-.05.92.92 0 00.32-.18l.08-.08a1 1 0 00.15-.2s0-.08.05-.13a.52.52 0 00.06-.13L17.37 16l.74 1.48a1 1 0 00.17.25.78.78 0 00.24.16h.09A1 1 0 0019 18h3a1 1 0 000-2z" />
                                </g>
                            </svg>
                        </div> <span class="font-bold text-blue-darker">Reports & Insights</span>
                    </li>
                    <li class="flex items-center mb-6">
                        <div class="leading-none mr-4"><svg class="fill-current" width="18px" height="20px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                                <path d="M250 200.087c-.01 14.862-2.727 29.09-7.68 42.224-13.132 4.955-27.366 7.68-42.234 7.69h-.172c-14.86-.01-29.09-2.727-42.222-7.68-4.954-13.132-7.682-27.366-7.692-42.232v-.173c.01-14.862 2.732-29.09 7.678-42.223 13.138-4.954 27.37-7.68 42.236-7.69h.172c14.868.01 29.102 2.736 42.233 7.69 4.952 13.134 7.67 27.362 7.68 42.224v.173zm147.22-33.42H280.474l82.55-82.55a200.92 200.92 0 0 0-21.612-25.548l-.004-.006a201.057 201.057 0 0 0-25.524-21.59l-82.55 82.55V2.782A201.232 201.232 0 0 0 200.104 0h-.212a201.23 201.23 0 0 0-33.226 2.78v116.747l-82.55-82.55a200.942 200.942 0 0 0-25.535 21.6l-.03.027a201.01 201.01 0 0 0-21.574 25.512l82.55 82.55H2.78S.004 188.596 0 199.926v.145a201.324 201.324 0 0 0 2.78 33.264h116.746l-82.55 82.55a201.137 201.137 0 0 0 47.14 47.14l82.55-82.548V397.22A201.347 201.347 0 0 0 199.86 400h.286a201.44 201.44 0 0 0 33.19-2.78V280.473l82.55 82.55a201.038 201.038 0 0 0 25.528-21.592l.02-.017a201.182 201.182 0 0 0 21.59-25.527l-82.55-82.552H397.22a201.347 201.347 0 0 0 2.78-33.19v-.287a201.44 201.44 0 0 0-2.78-33.19z" fill-rule="evenodd"></path>
                            </svg> </div> <span class="font-bold text-blue-darker">Note taking & comments</span>
                    </li>
                    <li class="flex items-center">
                        <div class="leading-none mr-4"><svg class="fill-current" width="20px" height="20px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z">
                                </path>
                            </svg> </div> <span class="font-bold text-blue-darker">Data Backups & Exports</span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="-ml-4 w-10/12 md:w-auto">
            <div class="bg-white pb-6 sm:px-10 sm:py-6 sm:rounded-t-md">
                <table class="w-full text-blue-darker text-sm sm:text-xs md:text-sm">
                    <tbody>
                        <tr class="border-t border-gray-dark  sm:border-0 ">
                            <td class="pl-6 py-3 sm:pl-0">Single</td>
                            <td class="py-3"><span class="font-bold">1</span> User </td>
                            <td class="pr-6 py-3 text-right sm:pr-0"><span class="bg-gray-darkest font-bold px-2 py-1 rounded-sm">&euro;5 / mo</span></td>
                        </tr>
                        <tr class="border-t border-gray-dark ">
                            <td class="pl-6 py-3 sm:pl-0">Family</td>
                            <td class="py-3"><span class="font-bold">12</span> Users </td>
                            <td class="pr-6 py-3 text-right sm:pr-0"><span class="bg-gray-darkest font-bold px-2 py-1 rounded-sm">&euro;10 / mo</span></td>
                        </tr>
                        <tr class="border-t border-gray-dark ">
                            <td class="pl-6 py-3 sm:pl-0">Team</td>
                            <td class="py-3"><span class="font-bold">20</span> Users </td>
                            <td class="pr-6 py-3 text-right sm:pr-0"><span class="bg-gray-darkest font-bold px-2 py-1 rounded-sm">&euro;20 / mo</span></td>
                        </tr>
                        <tr class="border-t border-gray-dark ">
                            <td class="pl-6 py-3 sm:pl-0">Custom</td>
                            <td class="py-3"><span class="font-bold">10's</span> Users </td>
                            <td class="pr-6 py-3 text-right sm:pr-0"><span class="bg-gray-darkest font-bold px-2 py-1 rounded-sm"><a href="mailto:sales@trach.io?subject=Interetsed in large group subscription!" class="font-semibold text-gray-900 hover:text-pink-500 mt-2">Contact Us</a></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="/register" class="block bg-indigo-600 hover:bg-blue-900 font-bold no-underline py-6 rounded-b text-center tracking-wide uppercase text-white">Start
                Free
                Trial <div class="inline-block ml-1 text-white"><svg class="fill-current" width="18px" height="14px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 14">
                        <g transform="translate(-1030.000000, -1764.000000)">
                            <g transform="translate(250.000000, 1468.000000)">
                                <path d="M794.585786,304 L781,304 C780.447715,304 780,303.552285 780,303 C780,302.447715 780.447715,302 781,302 L794.585786,302 L790.292893,297.707107 C789.902369,297.316582 789.902369,296.683418 790.292893,296.292893 C790.683418,295.902369 791.316582,295.902369 791.707107,296.292893 L797.707107,302.292893 C798.097631,302.683418 798.097631,303.316582 797.707107,303.707107 L791.707107,309.707107 C791.316582,310.097631 790.683418,310.097631 790.292893,309.707107 C789.902369,309.316582 789.902369,308.683418 790.292893,308.292893 L794.585786,304 Z">
                                </path>
                            </g>
                        </g>
                    </svg> </div>
            </a>
        </div>


    </div>

</section>



<!-- Footer Email Section -->
<section class="text-center pt-12 md:pt-32 pb-12 md:pb-40 bg-pink-500 relative">

    <div class="container mx-auto text-center px-5">
        <h1 class="w-full my-2 text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight text-left sm:text-center text-white">
            Sign up to be notified when we release!</h1>
        <h3 class="my-4 mb-6 lg:mb-4 text-xl lg:text-3xl leading-tight text-gray-200 text-left sm:text-center">Enter
            your email below to request early access.</h3>
        <form class="block sm:flex w-full px-0 sm:px-16 xl:pr-6 lg:pr-16 md:px-32 lg:px-0 lg:w-1/2 lg:m-auto lg:mt-8" action="/mailing-list-subscribe" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" novalidate="">
            @csrf
            <input class="bg-white border-2 border-white rounded py-2 px-4 block w-full focus:outline-none focus:border-indigo-400 text-black input" type="email" autofocus="" name="EMAIL" placeholder="jane@example.com">
            <button class="hover:bg-grey-darker text-white ml-0 sm:ml-4 py-2 px-6 rounded bg-gray-800 font-bold w-full sm:w-2/3 mt-4 sm:mt-0">Submit</button>
        </form>
    </div>

</section>
<!-- Return to Top -->
<a href="javascript:topFunction()" id="return-to-top"><i class="icon-chevron-up"></i></a>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        let element = document.getElementById('return-to-top');
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {

            element.style.display = "block";
            // fade(element);
            // document.getElementById("return-to-top").fadeIn(200);
        } else {
            element.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    //Tracheostomy patient monitoring app
    var typed = new Typed('#title', {
        strings: ["to give you piece of mind about the care of your loved one."
            , "helping to deliver advanced patient care through data insights."
            , "that has a patient first design."
        ]
        , typeSpeed: 60
        , backSpeed: 20
        , backDelay: 1500
        , startDelay: 0
        , loop: true
    });

</script>
<style type="text/css" data-typed-js-css="true">
    #return-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.7);
        width: 50px;
        height: 50px;
        display: block;
        text-decoration: none;
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        border-radius: 35px;
        display: none;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    #return-to-top i {
        color: #fff;
        margin: 0;
        position: relative;
        left: 16px;
        top: 13px;
        font-size: 19px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    #return-to-top:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    #return-to-top:hover i {
        color: #fff;
        top: 5px;
    }


    .typed-cursor {
        opacity: 1;
    }

    .typed-cursor.typed-cursor--blink {
        animation: typedjsBlink 0.7s infinite;
        -webkit-animation: typedjsBlink 0.7s infinite;
        animation: typedjsBlink 0.7s infinite;
    }

    @keyframes typedjsBlink {
        50% {
            opacity: 0.0;
        }
    }

    @-webkit-keyframes typedjsBlink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1;
        }
    }

    * {
        box-sizing: border-box
    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

</style>

@endsection
