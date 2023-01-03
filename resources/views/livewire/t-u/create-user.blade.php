<x-full-card title="Tambah Data">
  
    <div class="p-8 mb-6" x-data="{formKelas: ''}">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
                <p class="font-medium text-lg">Tambah Data Siswa atau Guru</p>
                <p>Pastikan data terisi secara keselurhan dan benar</p>
            </div>
            <div class="lg:col-span-2">
                <form wire:submit.prevent="submited" enctype="multipart/form-data">
                    @if (session()->has('succes'))
                        @livewire('component.alert', [
                            'status' => 'succes',
                            'message' => session('succes'),
                        ])
                    @endif
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    
                        <div class="md:col-span-2">
                            <label for="nomor_induk">Nomor Induk</label>
                            <div>
                                <input type="number" wire:model="nomor_induk" name="nomor_induk" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('nomor_induk') border-red-500 bg-red-50 @enderror " placeholder="Masukkan Nomor Induk"/>
                                @error('nomor_induk')
                                    <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label for="nama">Nama</label>
                            <input type="text" wire:model="nama" name="nama" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('nama') border-red-500 bg-red-50 @enderror " placeholder="Masukkan Nama" />
                            @error('nama')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-3">
                            <label class="block mb-1" for="file_input">Foto</label>
                            <input name="foto" wire:model="foto" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('foto') border-red-500 bg-red-50 @enderror">
                            @error('foto')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" wire:model="tgl_lahir" name="tgl_lahir" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('tgl_lahir') border-red-500 bg-red-50 @enderror" />
                            @error('tgl_lahir')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="">Gender</label>

                            <div class="flex items-center gap-10 mt-3 ml-2">
                                <div class="flex items-center">
                                    <input id="country-option-1" wire:model="gender" type="radio" name="countries" value="L" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"  checked="L">
                                    <label for="country-option-1" class="text-sm font-medium text-gray-900 ml-2 block">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="country-option-2" wire:model="gender" type="radio" name="countries" value="P" class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"  checked="P">
                                    <label for="country-option-2" class="text-sm font-medium text-gray-900 ml-2 block">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            @error('gender')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-3">
                            <label for="jabatan">Jabatan</label>
                            <select name="jabatan" x-model="formKelas" wire:model="jabatan" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('jabatan') border-red-500 bg-red-50 @enderror">
                                <option value="">~Pilih Jabatan~</option>
                                @foreach ($role as $roles)
                                    <option value="{{$roles->id}}">{{ $roles->role }}</option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-5" x-show="formKelas == 3"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" wire:model="kelas" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50">
                                <option value="">~Pilih Kelas~</option>
                                @foreach ($siswaKelas as $kel)
                                    <option value="{{$kel->id}}">Kelas {{$kel->kelas}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" wire:model="alamat" class="h-32 border mt-1 rounded px-2 w-full  border-gray-300 bg-gray-50 @error('alamat') border-red-500 bg-red-50 @enderror"></textarea>
                            @error('alamat')
                                <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                            @enderror
                        </div>
                
                        <div class="md:col-span-5 text-right">
                            <div class="inline-flex items-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-full-card>
