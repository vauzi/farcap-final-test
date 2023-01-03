
<section class="h-screen">
    <div class="px-6 h-full text-gray-800">
        <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6" >
            <div class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0">
                <img
                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="w-full"
                alt="Sample image" />
            </div>
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0" x-data="{showPass:false}">
                <form wire:submit.prevent="login">

                    {{-- alerrt message --}}
                    @if (session()->has('error'))
                        @livewire('component.alert', [
                            'status' => 'error',
                            'message' => session('error'),
                        ])
                    @endif

                    <div class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
                        <p class="text-center font-semibold mx-4 mb-0">Login</p>
                    </div>
        
                    <!-- Username input -->
                    <div class="mb-6">
                        <input
                        wire:model="username"
                        type="text"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 @error('password') border-red-300 bg-rose-50 @enderror rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Masukkan Username" />
                        @error('username') <span class="error">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Password input -->
                    <div class="mb-6">
                        <input
                        wire:model="password"
                        x-bind:type="showPass == false ? 'password' : 'text'"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 @error('password') border-red-300 bg-rose-50 @enderror rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="exampleFormControlInput2"
                        placeholder="Password"
                        />
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                
                    <div class="flex justify-between items-center mb-6">
                        <div class="form-group form-check">
                            <input  x-on:change="showPass = !showPass"
                            type="checkbox"
                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            id="exampleCheck2" />
                            <label class="form-check-label inline-block text-gray-800" for="exampleCheck2">
                                Show Password
                            </label>
                        </div>
                    </div>

                    <div class="text-center lg:text-left">
                        <button type="submit" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
