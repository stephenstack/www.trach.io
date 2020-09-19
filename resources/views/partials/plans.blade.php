
@foreach($plans as $plan)

    <input type="radio" id="{{ $plan->name }}-plan" name="plan" @if(auth()->user()->plan && auth()->user()->plan->name == $plan->name) checked @endif value="{{ $plan->name }}" class="radio-plan hidden ">
    <label for="{{ $plan->name }}-plan" class="border-2 border-gray-300 w-full px-4 py-3 block rounded-lg cursor-pointer mb-3 relative hover:border hover:border-indigo-500">
        <div class="flex">
            <img src="/images/plans/{{ $plan->name }}.png" class="w-16 h-16 mr-3">
            <div>
                <span class="block">{{ ucfirst($plan->name) }}</span>
                <span class="text-xs text-gray-700">{{ $plan->description }}</span>
                <span class="absolute right-0 bottom-0 bg-indigo-600 text-white font-bold rounded-br rounded-tl-lg text-xs px-2 py-1">
                    @if($plan->name == 'small')
                        €{{$plan->price}}/mo.
                    @elseif($plan->name == 'family')
                        €{{$plan->price}}/mo.
                    @elseif($plan->name == 'team')
                        €{{$plan->price}}/mo.
                    @endif
                </span>
            </div>
        </div>
    </label>
@endforeach