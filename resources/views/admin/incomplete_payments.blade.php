@extends('admin.layouts.app')

@section('content')

    <div class="p-4 w-full bg-white ml-4 mb-5 rounded">
        <h1 class="text-2xl font-bold text-gray-700 px-6 md:px-0">{{$results->count()}} Incomplete Payments</h1>

        <div class="w-full">

            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                    <tr>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">User Name</th>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">User Email</th>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Stripe ID </th>
                    <th class="py-4 px-6 bg-gray-300 font-bold uppercase text-sm text-gray-700 border-b border-gray-400">Last Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)

                        <tr class="hover:bg-gray-200">
                        <td class="py-4 px-6 border-b border-gray-400">{{$result->name}}</td>
                        <td class="py-4 px-6 border-b border-gray-400">{{$result->email}}</td>
                        <td class="py-4 px-6 border-b border-gray-400">{{$result->stripe_id}} </td>
                        <td class="py-4 px-6 border-b border-gray-400">{{ \Carbon\Carbon::parse($result->updated_at)->format('j F, Y') }}</td>

                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection()
