
@props(['imer'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if ($imer->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/>{{ urlencode($imer->user->email) }}"
                            alt="{{ $imer->user->name }}'s avatar" class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth>"
                            alt="Anonymous User" class="rounded-full" />
                    </div>
                </div>
            @endif


            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">{{ $imer->user ? $imer->user->name : 'Anonymous' }}</span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $imer->created_at->diffForHumans() }}</span>
                        @if ($imer->updated_at->gt($imer->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="text-sm text-base-content/60 italic">edited</span>
                        @endif
                    </div>

                    @can('update', $imer)
                        <div class="flex gap-1">
                            <a href="/imers/{{ $imer->id }}/edit" class="btn btn-ghost btn-xs"> Edit </a>
                            <form method="POST" action="/imers/{{ $imer->id }}"> @csrf @method('DELETE') <button
                                    type="submit" onclick="return confirm('Are you sure you want to delete this IMer?')"
                                    class="btn btn-ghost btn-xs text-error"> Delete </button>
                            </form>
                        </div>
                    @endcan
                </div>
                <p class="mt-1">{{ $imer->message }}</p>
            </div>
        </div>
    </div>
</div>