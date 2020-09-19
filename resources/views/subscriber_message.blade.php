@extends('app')

@section('title', 'trach.io - Tracheostomy patient monitoring app for your loved ones!')

@section('content')

@include('partials.nav')

<section class="bg-white">

    <div class="container mx-auto mt-0 pb-4 md:pb-24 px-5">

        <h2 class="w-full pt-4 sm:pt-8 text-xl sm:text-2xl font-semibold text-left text-gray-700 uppercase mb-8">Email Verified</h2>
        <div class="container mx-auto md:flex">
            <div class="w-full h-screen">
                <div class="w-full flex py-4">
                    {{-- <div class="flex-shrink-0">
                      <img class="h-12 w-12" src="/images/new_logos/blue_logos/rConfig_blue_trnsprnt_1_64px.png" alt="rConfig Logo">
                    </div> --}}
                    <div class="">
                      <p class="text-gray-700 leading-normal pt-4 mb-12 text-xl leading-loose tracking-wider">{{$message}}</p>
                      <a class="text-white py-2 px-6 rounded bg-indigo-600  w-full sm:w-2/3 mt-4 sm:mt-0 shadow hover:shadow-lg hover:bg-indigo-500" href="/register">Sign up for a trial</a>
                      <a class="text-blue-600 ml-0 sm:ml-4 py-2 px-6 rounded bg-gray-200 w-full sm:w-2/3 mt-4 sm:mt-0 shadow hover:shadow-lg hover:bg-gray-300 hover:text-blue-700 ml-6"  href="/">Learn More</a>
                    </div>
                  </div>
            </div>
            </div>
        </div>
    </div>
</section>

@endsection