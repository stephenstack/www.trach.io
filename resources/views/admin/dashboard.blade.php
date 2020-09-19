@extends('admin.layouts.app')

@section('content')

<div class="p-4 w-full bg-white ml-4  rounded">

    <div class="w-full">
        <div class="flex justify-between">
            <h1 class="font-semibold text-5xl lg:text-lg">Website Statistics</h1>
            <a class="text-blue-500 hover:text-blue-300" href="/admin" alt="refresh" title="refresh"><i
                    class="icon ion-ios-refresh"></i></a>
        </div>
        <div class="w-full text-4xl lg:text-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left"></th>
                        <th class="px-4 py-2 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-wallet mr-2 text-gray-600 inline-block "></i>
                            Homepage (www) Hits</td>
                        <td class="border px-4 py-2 text-indigo-700">{{$cntHomePageRequests}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-full mt-6">
        <div class="flex justify-between">
            <h1 class="font-semibold text-5xl lg:text-lg">Subscription Information</h1>
        </div>
        <div class="w-full text-4xl lg:text-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left"></th>
                        <th class="px-4 py-2 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-wallet mr-2 text-gray-600 inline-block "></i>
                            Current Subscriptions</td>
                        <td class="border px-4 py-2 text-indigo-700">{{$countCurrentSubs}}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-wallet mr-2 text-gray-600 inline-block "></i>
                            Expired Subscriptions</td>
                        <td class="border px-4 py-2 text-indigo-700">{{$countExpiredSubs}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- end first section --}}
    <div>
        <h1 class="mt-6 font-semibold text-5xl lg:text-lg">User Information</h1>
        <div class="w-full text-4xl lg:text-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left"></th>
                        <th class="px-4 py-2 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-people mr-2 text-gray-600 inline-block"></i>
                            Verified users</td>
                        <td class="border px-4 py-2 text-indigo-700"><a href="/admin/users">{{$verifiedUsersCnt}}</a></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-people mr-2 text-gray-600 inline-block"></i>
                            Unverified users</td>
                        <td class="border px-4 py-2 text-gray-700">{{$unverifiedUsersCnt}}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-mail mr-2 text-gray-600 inline-block"></i>
                            Verified subscribers</td>
                        <td class="border px-4 py-2 text-indigo-700"><a href="/admin/mailing_lists">{{$verifiedSubscribersCnt}}</a></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-mail mr-2 text-gray-600 inline-block"></i>
                            Unverified subscribers</td>
                        <td class="border px-4 py-2 text-gray-700">{{$unverifiedSubscribersCnt}}</td>
                    </tr>

                    {{-- <tr class="bg-gray-100">
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-chatbubbles mr-2 text-gray-600 inline-block"></i>
                            Open tickets
                        </td>
                        <td class="border px-4 py-2 text-indigo-700">{{$shareddata['openTicketsCount']}}</td>
                    </tr> --}}
                    {{-- <tr>
                        <td class="border px-4 py-2">
                            <i class="icon ion-ios-chatbubbles mr-2 text-gray-600 inline-block"></i>
                            All tickets
                        </td>
                        <td class="border px-4 py-2 text-indigo-700">{{$ticketCount}}</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
    {{-- end second section --}}
    <div>
        <h1 class="mt-6 font-semibold text-5xl lg:text-lg">System Information</h1>
        <div class="w-full text-4xl lg:text-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left"></th>
                        <th class="px-4 py-2 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td
                            class="border px-4 py-2  @if($shareddata['jobsCnt']){{ 'text-red-700 font-semibold' }}@endif">
                            <i class="icon ion-ios-paper mr-2 text-gray-600 inline-block"></i>
                            Current 'jobs' in Database queue</td>
                        <td class="border px-4 py-2 text-indigo-700">{{$shareddata['jobsCnt']}}</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td
                            class="border px-4 py-2 @if($shareddata['failedJobsCnt']){{ 'text-red-700 font-semibold' }}@endif">
                            <i class="icon ion-ios-paper mr-2 text-gray-600 inline-block"></i>
                            Failed jobs in Database queue</td>
                        <td class="border px-4 py-2 text-indigo-700">{{$shareddata['failedJobsCnt']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- end third section --}}
</div>


@endsection()
