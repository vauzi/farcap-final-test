<x-full-card title="Staf Dan Guru">

    @if (session()->has('succes'))
        @livewire('component.alert', [
            'status' => 'succes',
            'message' => session('succes'),
        ])
    @endif

    <div class="w-full"  x-data="{formKelas: ''}">
        <div class="relative flex flex-col min-w-0 break-words w-full text-gray-600">
            <div class="mb-7 flex justify-between items-center">
                <h3 class="text-xl font-medium">Daftar Staf Dan Guru</h3>
                <a href="/tu/user/create" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                      </svg>                      
                    Tambah Data
                </a>
            </div>
            <div class="block w-full overflow-x-auto ">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                        <tr>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Nama</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Nomor Induk</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Foto</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Jabatan</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Tanggal _lahir</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">gender </th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $key => $d)
                            <tr class="border-b">
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    {{$d->nama}}
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    {{$d->nomor_induk}}
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    <figure class="w-20 h-20 overflow-hidden rounded-lg">
                                        <img src="{{ asset($d->foto)}}" alt="" class="h-28 object-cover">
                                    </figure>
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    {{$d->role}}
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    {{$d->tgl_lahir}}
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left font-medium">
                                    @if ($d->gender == 'L')
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td class="border-t-0 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left flex items-center">
                                    {{-- start modal box --}}
                                    <x-modal-box luas="1000px">
                                        @slot('button')
                                        <button x-on:click="modelOpen =!modelOpen, title ='Datail Data'" wire:click="show({{$d->user_id}})" class="text-blue-500 hover:text-blue-700 p-3 rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-2 duration-200 mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        @endslot
                                        <div class="py-5 flex gap-16 justify-between w-full">
                                            @if ($detail !== null)
                                                <div>
                                                    <figure class="w-64 overflow-hidden h-[300px] rounded-md shadow-md">
                                                        <img src="{{ asset($detail->foto)}}" alt="" class="h-[300px] object-cover">
                                                    </figure>
                                                    <div class="flex gap-5 items-center flex-col justify-center w-64">
                                                        <button x-on:click="formFile = !formFile" x-show="!formFile" class="bg-green-500 hover:text-blue-700 p-3 text-white font-medium rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-1 duration-200 mt-3">
                                                            Ubah Foto
                                                        </button>
                                                        <button x-on:click="formFile = !formFile" x-show="formFile" class="bg-green-500 hover:text-blue-700 p-3 text-white font-medium rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-1 duration-200 mt-3">
                                                            Cencel
                                                        </button>
                                                        <form wire:submit.prevent="updateImage({{$d->user_id}})" x-show="formFile" enctype="multipart/form-data"
                                                            x-transition:enter="transition ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="transition ease-in duration-300"
                                                            x-transition:leave-start="opacity-100 scale-100"
                                                            x-transition:leave-end="opacity-0 scale-90"
                                                            >
                                                            <input name="foto" wire:model="foto" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                            <button x-on:click="modelOpen =!modelOpen, formFile = !formFile, title ='Datail Data'" class="bg-blue-500 hover:text-blue-700 py-3 w-full text-center text-white font-medium rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-1 duration-200 mt-3">
                                                                Save
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <form wire:submit.prevent="update({{$detail->id}})" class="text-sm flex flex-col gap-3">
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label class="w-1/3">Nomor Induk</label>
                                                        <input x-bind:disabled="!formEnable" type="number" wire:model="nomor_induk" name="nomor_induk" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50"/>
                                                    </div>
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label for="nama" class="w-1/3">Nama</label>
                                                        <input x-bind:disabled="!formEnable" type="text" wire:model="nama" name="nama" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50"/>
                                                    </div>
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label for="tgl_lahir" class="w-1/3">Tanggal Lahir</label>
                                                        <input x-bind:disabled="!formEnable" type="date" wire:model="tgl_lahir" name="tgl_lahir" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50"/>
                                                    </div>
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label for="gender" class="w-1/3">Gender</label>
                                                        <input x-bind:disabled="!formEnable" type="text" wire:model="gender" value="Laki-Laki" name="gender" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50"/>
                                                    </div>
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label for="jabatan" class="w-1/3">Jabatan</label>
                                                        <select x-bind:disabled="!formEnable" name="jabatan" wire:model="jabatan" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                                            {{-- <option value="">~Pilih Jabatan~</option> --}}
                                                            @foreach ($role as $roles)
                                                                <option value="{{$roles->id}}">{{ $roles->role }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-[500px] flex items-center gap-16 justify-between">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea x-bind:disabled="!formEnable" name="alamat" wire:model="alamat" x-bind:class="formEnable == false ? 'border-gray-300 cursor-auto':'border-blue-300 ring-1 ring-blue-300 cursor-text'" class="h-32 border mt-1 rounded px-2 w-[330px] bg-gray-50"></textarea>
                                                    </div>
                                                    <button x-on:click="formEnable = !formEnable, modelOpen =!modelOpen" x-show="formEnable" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
                                                </form>
                                            @endif
                                        </div>

                                        @slot('action')
                                            
                                            <button x-on:click="formEnable = !formEnable, title ='Edit Data'" x-show="!formEnable" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
                                        @endslot
                                    </x-modal-box>

                                    {{-- end modal box --}}

                                    <x-modal-box luas="500px">

                                        @slot('button')
                                            <button x-on:click="modelOpen =!modelOpen, title ='Warning'" class="text-red-500 hover:text-red-600 p-3 rounded-full hover:bg-slate-100 hover:shadow-md hover:-translate-y-2 duration-200 mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        @endslot

                                        <div class="text-center text-xl font-medium py-10">
                                            <p>Apakah anda Yakin ingin Menghapus data?</p>
                                        </div>

                                        @slot('action')
                                            <button x-on:click="modelOpen = false," wire:click="deleted({{$d->user_id}})" x-show="!formEnable" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                                        @endslot

                                    </x-modal-box>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Nama</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Nomor Induk</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Foto</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">jabatan</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Tanggal _lahir</th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">gender </th>
                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-pink-800 text-pink-300 border-pink-700">Action</th>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>

</x-full-card>
