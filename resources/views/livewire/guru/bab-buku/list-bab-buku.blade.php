<div class="w-full h-screen overflow-scroll">
    @if (session()->has('succes'))
        @livewire('component.alert', [
            'status' => 'succes',
            'message' => session('succes'),
        ])
    @endif
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
                    @if (Auth::user()->id == $buku->user_id)
                    <div class="self-end flex items-center gap-5">
                        {{-- start modal box --}}
                        <x-modal-box luas="1100px">
                            @slot('button')
                            <button x-on:click="modelOpen =!modelOpen, title ='Tamabah Bab'" class="block uppercase mx-auto shadow bg-emerald-800 hover:bg-emerald-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                                Tambah Bab
                            </button>
                            @endslot
                            <div class="w-[1000px]">
                                <div class="lg:col-span-2 my-4">
                                    <form wire:submit.prevent="createBab">
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                            <div class="md:col-span-2">
                                                <label class="block mb-1" for="nama_bab">Bab</label>
                                                <select name="nama_bab" wire:model="nama_bab" type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
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
                                            <div class="md:col-span-3">
                                                <label class="block mb-1" for="sub_bab">Sub Bab</label>
                                                <input name="sub_bab" wire:model="sub_bab" type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
                                            </div>
                                            <div class="md:col-span-5">
                                                <label for="materi" class="block mb-2 text-sm font-medium text-gray-900">Materi</label>
                                                <textarea id="materi" name="materi" wire:model="materi" rows="4" class="block p-2.5 w-full max-w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 no-tailwindcss-base" placeholder="Your post here..." name="content"></textarea>
                                            </div>
                                        </div>
                                        <button x-on:click="modelOpen = !modelOpen," class="block mt-9 uppercase mx-auto shadow bg-rose-800 hover:bg-rose-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @slot('action')
                                
                            @endslot
                            
                        </x-modal-box>
                        {{-- end modal box --}}

                        
                        <x-modal-box luas="500px">
                            
                            @slot('button')
                            <button x-on:click="modelOpen =!modelOpen" class="block uppercase mx-auto shadow bg-rose-800 hover:bg-rose-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Hapus</button>
                                
                            @endslot

                            <div class="text-center text-xl font-medium py-10">
                                <p>Apakah anda Yakin ingin Menghapus data?</p>
                            </div>

                            @slot('action')
                                <button x-on:click="modelOpen = false," wire:click="deleted({{$buku->buku_id}})"  x-show="!formEnable" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                            @endslot

                        </x-modal-box>

                    </div>
                    @endif
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
        <div class="bg-white shadow rounded mb-4 p-4 w-full px-28">
            {{-- @if (!$bab == null)
                <h1 class="text-3xl text-gray-700 text-center font-semibold">Buku Belum Memiliki Isi Bab</h1>
            @endif --}}

            <h1 class="text-center text-gray-900 text-3xl font-extrabold">{{$serchBab}}</h1>
            @foreach ($bab as $babs)

                <h3 class="text-left text-xl text-gray-800 mt-10 font-semibold uppercase flex flex-wrap gap-5">
                    {{$babs->sub_bab}}
                    @if (Auth::user()->id == $buku->user_id)
                    <x-modal-box luas="500px">
                        @slot('button')
                            <button x-on:click="modelOpen =!modelOpen" class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
                                Hapus Sub Bab
                            </button>
                        @endslot

                        <div class="text-center text-xl font-medium py-10">
                            <p>Apakah anda Yakin ingin Menghapus Subab Ini?</p>
                        </div>

                        @slot('action')
                            <button x-on:click="modelOpen = !modalOpen," wire:click="deleteSubBab({{$babs->id}})" x-show="!formEnable" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                        @endslot
                    </x-modal-box>
                    <x-modal-box luas="1000px">
                        @slot('button')
                            <button x-on:click="modelOpen =!modelOpen" wire:click="showBabBuku({{$babs->id}})" class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">
                                Edit Sub Bab
                            </button>
                        @endslot

                        <form wire:submit.prevent="upadteBabBuku({{$babs->id}})">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 font-normal">
                                <div class="md:col-span-2">
                                    <label class="block mb-1" for="nama_bab">Bab</label>
                                    <select name="nama_bab" wire:model="nama_bab" type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
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
                                <div class="md:col-span-3">
                                    <label class="block mb-1" for="sub_bab">Sub Bab</label>
                                    <input name="sub_bab" wire:model="sub_bab" type="text" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none">
                                </div>
                                <div class="md:col-span-5">
                                    <label for="materi" class="block mb-2 text-sm font-medium text-gray-900">Materi</label>
                                    <textarea id="materi" name="materi" wire:model="materi" rows="4" class="block p-2.5 w-full max-w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 no-tailwindcss-base" placeholder="Your post here..." name="content"></textarea>
                                </div>
                            </div>
                            <button x-on:click="modelOpen = !modelOpen," class="block mt-9 uppercase mx-auto shadow bg-rose-800 hover:bg-rose-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">
                                Save
                            </button>

                        @slot('action')
                        @endslot
                    </x-modal-box>

                    @endif
                </h3>
                <p class="ml-5 text-sm text-gray-600 mt-3">{{$babs->materi}}</p>
            @endforeach

        </div>
    </div>
</div>
