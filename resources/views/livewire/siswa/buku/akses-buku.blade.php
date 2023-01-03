<div class="w-full h-screen overflow-scroll">
    <div class="flex items-center justify-between p-5 bg-sky-800 pb-36">
        <div>
            <h1 class="text-gray-100 text-2xl font-semibold">Akses Buku</h1>
            <p class="text-gray-300 text-sm mt-2">Dashboard > Akses Buku</p>
        </div>
        <div class="h-10 w-10 bg-gray-500 rounded-full"></div>
    </div>
    <div class="px-7 -mt-24">
        <div class="bg-indigo-700 px-4 py-5 border-b rounded-t sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-white">
                Daftar Buku
            </h3>
        </div>
        @foreach ($buku as $b)
        <div class="bg-white shadow overflow-hidden sm:rounded-md p-5">
            <ul class="divide-y divide-gray-200">
                <li class="flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center">
                        <figure class="h-64 w-52 overflow-hidden">
                            <img src="{{asset($b->foto)}}" alt="Buku" class="w-48 object-cover">
                        </figure>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-gray-900 font-semibold text-2xl truncate">
                                    {{$b->judul}}
                                </p>
                            </div>
                            <div class="mt-1 sm:flex sm:justify-between">
                                <div class="flex flex-col">
                                    <p class="flex items-center text-sm font-light text-gray-500">
                                        <time datetime="2020-01-07">{{$b->created_at}}</time>
                                        <span class="ml-5">Kelas : {{$b->kelas}}</span>
                                        <span class="ml-5">Semester : {{$b->semester}}</span>
                                    </p>
                                    <div class="w-[700px] h-20 overflow-hidden">
                                        <p class="flex items-center text-sm font-light text-gray-500">
                                            {{$b->deskripsi}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <figure class="h-16 w-16 rounded-full overflow-hidden">
                                    <img src="{{asset($b->foto_pengarang)}}" alt="Foto Penginput buku" class="h-24 object-cover">
                                </figure>
                                <div class="flex flex-col gap-1">
                                    <p>{{$b->pengarang}}</p>
                                    <p>{{$b->jabatan}}</p>
                                </div>
                                <a href="{{ route('siswa.bab-buku', ['buku_id' => $b->buku_id])}}" x-on:click="openCard = true" class="inline-flex items-end ml-32 px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                    Baca Buku
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </li>
            </ul>    
        </div>
        @endforeach
    </div>