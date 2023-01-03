
<div class="w-full h-screen overflow-scroll">
    <div class="flex items-center justify-between p-5 bg-sky-800 pb-36">
        <div>
            <h1 class="text-gray-100 text-2xl font-semibold">Isi Buku</h1>
            <p class="text-gray-300 text-sm mt-2">Dashboard > Buku > Bab Buku</p>
        </div>
        <div class="h-10 w-10 bg-gray-500 rounded-full"></div>
    </div>
    <div class="px-7 -mt-24">
        <div class="bg-white shadow rounded-lg mb-4 p-4 w-full border-l-4 border-blue-600">
            <div class="flow-root">
                <div class="divide-y divide-gray-200 flex justify-between">
                    <div class="flex">
                        <figure class="h-56 w-52 overflow-hidden">
                            <img src="{{asset($buku->foto)}}" alt="" class="h-56 object-cover">
                        </figure>
                        <div class="flex flex-col">
                            <div>
                                <h1 class="font-semibold text-2xl w-[500px] inline-block">{{$buku->judul}}</h1>
                                <div class="flex text-xs font-normal text-gray-500 gap-5">
                                    <p>{{$buku->time}}</p>
                                    <p>Kelas : {{$buku->kelas}}</p>
                                    <p>Semester : {{$buku->semester}}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mt-5 h-20 w-[500px] overflow-hidden">{{$buku->deskripsi}}</p>
                            </div>
                            <div class="flex items-center justify-between mt-5">
                                <div class="flex items-center gap-3">
                                    <figure class="h-12 w-12 overflow-hidden rounded-full">
                                        <img src="{{asset($buku->foto_profile)}}" alt="" class="h-12 object-cover">
                                    </figure>
                                    <div class="flex flex-col gap-2">
                                        <h3 class="text-sm font-semibold uppercase">{{$buku->nama_penginput}}</h3>
                                        <p class="uppercase text-xs text-gray-500">{{$buku->jabatan}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-7">
        <div class="bg-white shadow rounded mb-4 p-4 w-full">
            <div class="lg:col-span-2 my-4">
                <form wire:submit.prevent="createBab">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-2">
                            <select name="serchBab" wire:model="serchBab" type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
                                <option value="">~Pilih BAB~</option>
                                <option value="BAB I">BAB I</option>
                                <option value="BAB II">BAB II</option>
                                <option value="BAB III">BAB III</option>
                                <option value="BAB IV">BAB IV</option>
                                <option value="BAB V">BAB V</option>
                                <option value="BAB VI">BAB VI</option>
                                <option value="BAB VII">BAB VII</option>
                                <option value="BAB VIII">BAB VIII</option>
                                <option value="BAB IX">BAB IX</option>
                                <option value="BAB X">BAB X</option>
                                <option value="BAB XI">BAB XI</option>
                                <option value="BAB XII">BAB XII</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="px-7">
        <div class="bg-white shadow rounded mb-4 p-4 w-full">
            {{-- @if (!$bab == null)
                <h1 class="text-3xl text-gray-700 text-center font-semibold">Buku Belum Memiliki Isi Bab</h1>
            @endif --}}

            <h1 class="text-center text-gray-900 text-3xl font-extrabold">{{$serchBab}}</h1>
            @foreach ($bab as $babs)

                <h3 class="text-left text-xl text-gray-800 font-semibold">{{$babs->sub_bab}}</h3>
                <p class="ml-7 text-sm text-gray-600">{{$babs->materi}}</p>
            @endforeach

        </div>
    </div>
</div>
