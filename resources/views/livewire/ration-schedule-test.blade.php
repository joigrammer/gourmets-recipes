<div class="mx-auto mt-8">
    <div class="flex items-start conainter bg-white overflow-hidden">
        <div class="bg-gray-200 rounded-lg p-5" style="width: 325px;">
            <div class="flex flex-col text-xl leading-5 my-2">
                <span>{{ $schedule->today }}</span>
                <span class="text-3xl">{{ $schedule->date }}</span>
            </div>
            <div class="flex justify-between py-1.5">
                <img class="w-6 cursor-pointer transform transition duration-100 hover:scale-125" src="{{ asset('/schedule/icons/left.svg') }}" alt="left" wire:click="prev">
                <span class="text-xl font-bold uppercase">{{ $schedule->month }}</span>
                <img class="w-6 cursor-pointer transform transition duration-100 hover:scale-125" src="{{ asset('/schedule/icons/right.svg') }}" alt="right" wire:click="next">
            </div>
            <div class="flex flex-wrap">
                @foreach($schedule->days as $day)
                <div style="width: 14.28%" class="py-2">
                    <div class="text-gray-600 text-base uppercase tracking-wide font-bold text-center">{{ $day }}</div>
                </div>
                @endforeach
            </div>
            <div class="flex flex-wrap mb-5">
                @foreach($schedule->blankDays as $blankDay)
                <div style="width: 14.28%; height: 35px"></div>
                @endforeach
                @foreach($schedule->noOfDays as $date)
                <div style="width: 14.28%; height: 35px" class="flex justify-center pt-2 border-r border-b relative">
                    <div class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100 bg-white @if($this->isToday($date)) bg-blue-500 text-white @else text-gray-700 hover:bg-blue-200 @endif @if($focusDay == $date) bg-yellow-500 @endif" wire:click="search({{ $date }})">{{ $date }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex-grow px-4">
            <div class="px-2 pb-2 mb-4 font-bold text-3xl border-b-4 w-full border-dashed border-gray-300">
                {{ $schedule->dateFocus }}
            </div>
            @foreach($recipes as $recipe)
                @livewire('recipe-schedule', [
                    'recipe' => $recipe,                    
                ], key($recipe->slug))
            @endforeach
            <!--<div class="flex justify-center border-4 w-full border-dashed border-gray-200 rounded-lg h-96">                
                <div class="flex flex-col items-center justify-center text-gray-500">
                    <img class="w-16 opacity-25" src="{{ asset('/icons/serving-dish.svg') }}" alt="serving-dish">
                    <span class="text-2xl">No hay raciones</span>
                    <span class="text-2xl">para este día</span>
                </div>
            </div>-->
        </div>
    </div>
</div>