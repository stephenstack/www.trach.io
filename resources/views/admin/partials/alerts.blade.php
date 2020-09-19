
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