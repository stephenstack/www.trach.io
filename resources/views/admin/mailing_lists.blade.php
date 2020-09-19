@extends('admin.layouts.app')

@section('content')


    <div class="p-4 w-full bg-white ml-4 mb-5 rounded">
        <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">{{$results->total()}} Subscribers</h1>

        <div class="w-full">

            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                    <tr>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Subscriber Email</th>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Subscribed Date</th>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr class="hover:bg-gray-200">
                        <td class="py-4 px-6 border-b border-gray-400">{{$result->email}}</td>
                        <td class="py-4 px-6 border-b border-gray-400">{{ \Carbon\Carbon::parse($result->created_at)->format('j F, Y') }} </td>
                        <td class="py-4 px-6 border-b border-gray-400 text-right">
                            <a href="#" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-green-600 hover:bg-green-700 opacity-50 cursor-not-allowed">Edit</a>
                            <a href="#" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-blue-600 hover:bg-blue-700 opacity-50 cursor-not-allowed">View</a>
                            <a href="#" class="text-gray-200 font-bold py-1 px-3 rounded text-xs bg-red-600 hover:bg-red-700 opacity-50 cursor-not-allowed">Delete</a>
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
