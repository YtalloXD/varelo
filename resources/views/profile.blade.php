<x-layout>
    <x-slot:title>
        Profile Settings
    </x-slot:title>

    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-8">Profile Settings</h1>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="font-bold">Erro ao fazer upload:</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <div class="flex items-center gap-4 mb-6">
                    @if (auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                             alt="Profile Image" 
                             class="w-24 h-24 rounded-full object-cover">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" 
                             alt="Default Image" 
                             class="w-24 h-24 rounded-full object-cover">
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                        <p class="text-base-content/60">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label" for="profile_image">
                            <span class="label-text">Escolher Imagem de Perfil</span>
                        </label>
                        <input type="file" 
                               name="profile_image" 
                               id="profile_image" 
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="file-input file-input-bordered w-full @error('profile_image') file-input-error @enderror">
                        @error('profile_image')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="label">
                            <span class="label-text-alt">Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB</span>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>