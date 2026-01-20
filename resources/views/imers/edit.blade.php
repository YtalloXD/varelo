
<x-layout>
    <x-slot:title>
        Edit IMer
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Edit IMer</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/imers/{{ $imer->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message', $imer->message) }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="/" class="btn btn-ghost btn-sm">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Update IMer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>