@extends('admin.layouts.app')

@section('content')


    <div class="p-4 w-full bg-white ml-4 mb-5 rounded">
        <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">{{$results->total()}} current jobs</h1>
        @include('admin.partials.alerts')
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <div class="flex justify-end my-4">
                    <a class="bg-red-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer  hover:shadow-xl mr-4" href="/admin/jobs-delete-all">Delete all</a>
                    <a class="bg-indigo-500 text-white text-sm font-medium px-6 py-2 rounded float-right uppercase cursor-pointer  hover:shadow-xl" href="/admin/jobs-retry-all">Retry all</a>
                </div>
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Queue Name</th>
                        <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Payload</th>
                        <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Attempts</th>
                        <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Created</th>
                        <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($results as $result)
                            <tr class="hover:bg-gray-200">
                                <td class="py-4 px-6 border-b border-gray-400">{{$result->queue}}</td>
                                <td class="py-4 px-6 border-b border-gray-400 break-all">{{str_limit($result->payload, 150 )}}</td>
                                <td class="py-4 px-6 border-b border-gray-400">{{$result->attempts}}</td>
                                <td class="py-4 px-6 border-b border-gray-400">{{ \Carbon\Carbon::createFromTimestamp($result->created_at)->format('j F, Y') }} </td>
                                <td class="py-4 px-6 border-b border-gray-400 text-right">
                                    <a href="/admin/view-ticket/{{$result->id}}" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-blue-600 hover:bg-blue-700 ">View</a>
                                    <a href="/admin/delete-ticket/{{$result->id}}" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-red-600 hover:bg-red-700 ">Retry</a>
                                    <a href="/admin/delete-ticket/{{$result->id}}" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-red-600 hover:bg-red-700 ">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
                </table>
            </div>
            {{-- https://github.com/lorisleiva/tailwindcss-plugins/tree/master/pagination --}}
            <div class="flex justify-between">
                <div class="w-1/2">Page {{$results->currentPage()}} of {{$results->lastPage()}}</div>
                <div class="w-1/2 items-end">{{ $results->links() }}</div>
            </div>
        </div>

    </div>

@endsection()
