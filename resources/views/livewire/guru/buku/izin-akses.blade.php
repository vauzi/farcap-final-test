<div class="w-full h-screen overflow-scroll" x-data="{openCard: false}" >
    <div class="flex items-center justify-between p-5 bg-sky-800 pb-36">
        <div>
            <h1 class="text-gray-100 text-2xl font-semibold">Izin Akses Buku</h1>
            <p class="text-gray-300 text-sm mt-2">Dashboard > Izin Akses Buku</p>
        </div>
        <div class="h-10 w-10 bg-gray-500 rounded-full"></div>
    </div>
    <div class="px-7 -mt-24">
        <div class="bg-white shadow rounded-lg mb-4 p-4 w-full border-l-4 border-blue-600">
            <div class="flow-root">
                <div class="divide-y divide-gray-200">
                    
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-2">
                            <label for="judulBuku">Judul Buku</label>
                            <input type="text" wire:model="judulBuku" name="judulBuku" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50" placeholder="Masukkan Judul Buku"/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    @if ($bukuById !== null)
        <div class="px-7" >
            <div class="bg-white shadow rounded-lg mb-4 p-4 w-full" x-show="openCard"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                >
                <ul class="divide-y divide-gray-200">
                    <li class="flex items-center justify-between hover:bg-gray-50">
                        <div class="flex items-center">
                            <figure class="h-32 w-24 overflow-hidden">
                                <img src="{{ asset($bukuById->foto)}}" alt="Buku" class="w-48 object-cover">
                            </figure>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-900 font-semibold text-2xl truncate">
                                        {{ $bukuById->judul }}
                                        {{$bukuById->id}}
                                    </p>
                                </div>
                                <div class="mt-1 sm:flex sm:justify-between">
                                    <div class="flex flex-col">
                                        <p class="flex items-center text-sm font-light text-gray-500">
                                            <time datetime="2020-01-07">{{$bukuById->created_at}}</time>
                                            {{-- <span class="ml-5">Kelas : {{$bukuById->kelas}}</span> --}}
                                            <span class="ml-5">Semester : {{$bukuById->semester}}</span>
                                        </p>
                                        <div class="w-[700px] h-20 overflow-hidden">
                                            <p class="flex items-center text-sm font-light text-gray-500">
                                                {{$bukuById->deskripsi}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <x-modal-box luas="700px">

                    @slot('button')
                        <button wire:click="getAllSiswa()" x-on:click="modelOpen =!modelOpen, title ='Tambah Akses Buku'" class="text-gray-50 bg-green-500 hover:text-green-600 p-3 rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-2 duration-200 mt-3">
                            Tambahkan Akses siswa
                        </button>
                    @endslot
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-2">
                            <label for="siswa">Cari Siswa</label>
                            <input type="text" wire:model="siswa" name="siswa" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50" placeholder="Masukkan Judul Buku"/>
                        </div>
                    </div>
                    {{$siswa}}
                    <table class="table text-gray-400 border-separate space-y-6 text-sm mt-5 mx-auto">
                        <thead class="bg-gray-300 text-gray-500">
                            <tr>
                                <th class="p-3">Nama</th>
                                <th class="p-3 text-left">Kelas</th>
                                <th class="p-3 text-left">Gender</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        @if ($getSiswa !== null)
                        <tbody>
                            @foreach ($getSiswa as $s)
                                <tr class="">
                                    <td class="p-3">
                                        <div class="flex align-items-center">
                                            <img class="rounded-full h-12 w-12  object-cover" src="{{asset($s->foto)}}" alt="unsplash image">
                                            <div class="ml-3">
                                                <div class="text-gray-500">{{$s->nama}}</div>
                                                <div class="">{{$s->nomor_induk}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        {{$s->kelases}}
                                    </td>
                                    <td class="p-3 font-bold">
                                        @if ($s->gender == 'L')
                                            Laki-Laki
                                        @else
                                            Perempuan
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <button x-on:click="modelOpen = !modelOpen," wire:click="createAkses({{$s->user_id}})" class="bg-green-400 text-gray-50 rounded-md px-2">Add</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    @slot('action')
                        
                    @endslot

                </x-modal-box>

                <table class="table text-gray-400 border-separate space-y-6 text-sm mt-5 mx-auto">
                    <thead class="bg-gray-300 text-gray-500">
                        <tr>
                            <th class="p-3">Foto</th>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Nomor Induk</th>
                            <th class="p-3 text-left">Kelas</th>
                            <th class="p-3 text-left">Gender</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    @if ($aksesSiswa !== null)
                    <tbody>
                        @foreach ($aksesSiswa as $akses)
                            <tr class="">
                                
                                <td class="p-3">
                                    <div class="flex align-items-center">
                                        <img class="rounded-full h-12 w-12  object-cover" src="{{asset($akses->foto)}}" alt="unsplash image">
                                    </div>
                                </td>
                                <td class="p-3">
                                    {{$akses->nama}}
                                </td>
                                <td class="p-3">
                                    {{$akses->nomor_induk}}
                                </td>
                                <td class="p-3">
                                    {{$akses->kelas}}
                                </td>
                                <td class="p-3 font-bold">
                                    @if ($akses->gender == 'L')
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td class="p-3">
                                    <button wire:click="deleteAkses({{$akses->akses_id}})" class="bg-red-400 text-gray-50 rounded-md px-2">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>

            </div>
        </div>
    @endif
    <div class="px-7">
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
                            <figure class="h-32 w-24 overflow-hidden">
                                <img src="{{ asset($b->foto)}}" alt="Buku" class="w-48 object-cover">
                            </figure>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-900 font-semibold text-2xl truncate">
                                        {{ $b->judul }}
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

                            </div>
                        </div>
                        <button x-on:click="openCard = true" wire:click="getBukuById({{$b->id}})" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>                      
                            Add
                        </button>
                    </li>
                </ul>    
            </div>
        @endforeach
    </div>
</div>