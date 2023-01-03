<div class="w-full h-screen overflow-scroll">
    <div class="flex items-center justify-between p-5 bg-sky-800 pb-36">
        <div>
            <h1 class="text-gray-100 text-2xl font-semibold">{{$title}}</h1>
            <p class="text-gray-300 text-sm mt-2">Dashboard > {{$title}}</p>
        </div>
        <div class="h-10 w-10 bg-gray-500 rounded-full"></div>
    </div>
    <div class="px-7 -mt-24">
        {{$slot}}
    </div>
</div>