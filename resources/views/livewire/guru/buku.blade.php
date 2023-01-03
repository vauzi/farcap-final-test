<x-card-image title="Daftar Buku">
    <div class="w-48 mb-4">
        <a href="/guru/buku/create" class="block text-center uppercase mx-auto shadow bg-rose-800 hover:bg-rose-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
            Tambah Buku
        </a>
    </div>
    <div class="flex items-center flex-wrap gap-10">

        @foreach ($data as $d)
        <div class="bg-white shadow rounded-lg mb-4 p-4 w-[47%] border-l-4 border-blue-600">
            <div class="flow-root">
                <div class="flex gap-3">
                    <figure class="h-56 w-52 overflow-hidden">
                        <img src="{{asset($d->foto)}}" alt="" class="h-56 object-cover">
                    </figure>
                    <div class="flex flex-col">
                        <div>
                            <h1 class="font-semibold text-2xl">{{$d->judul}}</h1>
                            <div class="flex text-xs font-normal text-gray-500 gap-5">
                                <p>{{$d->time}}</p>
                                <p>Kelas : {{$d->kelas}}</p>
                                <p>Semester : {{$d->semester}}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mt-5 h-20 w-72 overflow-hidden">{{$d->deskripsi}}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <figure class="h-12 w-12 overflow-hidden rounded-full">
                                    <img src="{{asset($d->foto_profile)}}" alt="" class="h-12 object-cover">
                                </figure>
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm font-semibold uppercase">{{$d->nama_penginput}}</h3>
                                    <p class="uppercase text-xs text-gray-500">{{$d->jabatan}}</p>
                                </div>
                            </div>
                            <a href="{{ route('guru.bab-buku', ['buku_id' => $d->buku_id])}}" class="flex items-center gap-2">
                                <p class="text-xs text-blue-600">Reed more</p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-blue-600">
                                    <path fill-rule="evenodd" d="M3.75 12a.75.75 0 01.75-.75h13.19l-5.47-5.47a.75.75 0 011.06-1.06l6.75 6.75a.75.75 0 010 1.06l-6.75 6.75a.75.75 0 11-1.06-1.06l5.47-5.47H4.5a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                                </svg>                                  
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</x-card-image>