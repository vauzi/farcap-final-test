<x-full-card title="Tambah Buku">
    @if (session()->has('succes'))
        @livewire('component.alert', [
            'status' => 'succes',
            'message' => session('succes'),
        ])
    @endif
    <div class="p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
                <p class="font-medium text-lg">Tambah Buku</p>
                <p>Pastikan data terisi secara keselurhan dan benar</p>
            </div>
            <div class="lg:col-span-2">
                <form wire:submit.prevent="submited" class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5" enctype="multipart/form-data">
                    <div class="md:col-span-3">
                        <label for="judul">Judul Buku</label>
                        <input type="text" wire:model="judul" name="judul" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('judul') border-red-500 bg-red-50 @enderror" placeholder="Masukkan Judul Buku"/>
                        @error('judul')
                            <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="cover">Cover</label>
                        <input name="cover" wire:model="cover" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('cover') border-red-500 bg-red-50 @enderror">
                        @error('cover')
                            <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-3">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" wire:model="kelas" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('semester') border-red-500 bg-red-50 @enderror">
                            <option value="">~Pilih Kelas~</option>
                            @foreach ($data as $d)
                                <option value="{{$d->id}}">Kelas {{$d->kelas}}</option>
                            @endforeach
                        </select>
                        @error('semester')
                            <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="semester">Semester</label>
                        <select name="semester" wire:model="semester" class="h-10 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('semester') border-red-500 bg-red-50 @enderror">
                            <option value="">~Pilih Semester~</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                        </select>
                        @error('semester')
                            <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-5">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" wire:model="deskripsi" class="h-32 border mt-1 rounded px-4 w-full border-gray-300 bg-gray-50 @error('deskripsi') border-red-500 bg-red-50 @enderror"></textarea>
                        @error('semester')
                            <p class="text-red-600 text-xs ml-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-5 text-right">
                        <div class="inline-flex items-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-full-card>