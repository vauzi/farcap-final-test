<div class="w-full h-screen overflow-scroll">
    <div class="flex items-center justify-between p-5 bg-sky-800 pb-36">
        <div>
            <h1 class="text-gray-100 text-2xl font-semibold">{{$title}}</h1>
            <p class="text-gray-300 text-sm mt-2">Dashboard > {{$title}}</p>
        </div>
        <div class="h-10 w-10 bg-gray-500 rounded-full"></div>
    </div>
    <div class="px-7 -mt-24">
        <div class="bg-white shadow rounded-lg mb-4 p-4 w-full border-l-4 border-blue-600">
            <div class="flow-root">
                <div class="divide-y divide-gray-200">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>