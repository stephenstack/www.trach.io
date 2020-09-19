@extends('app')

@section('title', 'trach.io - Tracheostomy patient monitoring app for your loved ones!')

@section('content')

@include('partials.nav')

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

<!-- Hero Section -->
<section class="flex font-sans container m-auto flex px-5">
    <div class="flex-1 hidden items-start flex-col justify-center lg:flex relative pl-16">
        <form action="{{url('/invitee-request')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="w-full bg-white rounded-lg mx-auto mt-8 flex overflow-hidden rounded-b-none">
                <div class="w-1/3 bg-gray-100 p-8 hidden md:inline-block">
                    <h2 class="font-medium text-md text-gray-700 mb-4 tracking-wide">Complete sign-up</h2>
                    <p class="text-xs text-gray-500">Setup your basic profile information such as Email Address and Name, and set a secure password. <br /> Once submitted, your request will be sent to an administrator for approval. You will be notified via email once approved.</p>
                </div>
                <div class="md:w-2/3 w-full">
                    <input type="hidden" name="tenant_id" value="{{$tenant_id}}">
                    <div class="pt-4 pb-4 px-4 lg:px-16">
                        <label for="name" class="text-sm text-gray-600">Your Name</label>
                        <input class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 {{ $errors->has('name') ? ' border-red-500' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                        @if ($errors->has('name'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('name') }}
                        </p>
                        @endif
                    </div>
                    <div class="pt-4 pb-8 px-4 lg:px-16">
                        <label for="email" class="text-sm text-gray-600">Your Email Address</label>
                        <input type="email" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 {{ $errors->has('email') ? ' border-red-500' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        @if ($errors->has('email'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('email') }}
                        </p>
                        @endif
                    </div>
                    <div class="pt-4 pb-8 px-4 lg:px-16">
                        <label for="email" class="text-sm text-gray-600">Password</label>
                        <input type="password" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 {{ $errors->has('password') ? ' border-red-500' : '' }}" name="password" value="{{ old('password') }}" required autofocus placeholder="Password">
                        <input id="password-confirm" type="password" class="mt-2 border-2 border-gray-200 px-3 py-2 block w-full rounded-lg text-base text-gray-900 focus:outline-none focus:border-indigo-500 {{ $errors->has('password') ? ' border-red-500' : '' }}" name="password_confirmation" required autofocus placeholder="Confirm Password">
                        @if ($errors->has('password'))
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $errors->first('password') }}
                        </p>
                        @endif
                    </div>
                    <hr class="border-gray-200">
                    <div class="flex flex-wrap py-4 px-16">
                        <input name="subscription" :id="id" type="checkbox" class="form-checkbox" checked>
                        <div class="text-sm text-gray-600  ml-4">Subscribe to mailing list</div>
                    </div>
                </div>

            </div>
            <div class="p-16 py-8 bg-gray-300 clearfix rounded-b-lg border-t border-gray-200">
                <p class="hidden md:flex float-left text-xs text-gray-500 tracking-tight mt-2">Click on submit to send your Info to an admin</p>
                <button type="submit" class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer">Request access</button>
            </div>
        </form>
    </div>
</section>


@endsection
