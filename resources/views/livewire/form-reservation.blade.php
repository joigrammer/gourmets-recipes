<form class="flex gap-1.5 mt-4 p-1.5" action="{{ route('rations.store', ['ration' => $ration->id]) }}" method="post">
    @csrf    
    <input type="number" name="rations" class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" id="rations" min="1" value="1" max="{{ $ration->available() }}">
    @error('rations')
    <p>{{ $message }}</p>
    @enderror
    <input type="submit" value="reservar" class="p-1.5 bg-red-500 text-xl font-bold hover:bg-red-700 text-white rounded-lg uppercase" style="font-family: 'Truculenta', sans-serif;"/>
</form>