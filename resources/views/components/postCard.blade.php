@props(['post' ,'full' => false])

<div class="bg-white p-6 rounded-lg shadow-lg border border-slate-200 overflow-hidden">

{{-- White shadowy photo frame --}}
<div>
    @if ($post->image)
    <div class="h-auto w-1/2 rounded-md overflow-hidden self-start bg-white shadow-md p-2">
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="object-cover object-center rounded-md w-full h-full">
    </div>
    @else

        @endif
</div>


    <h2 class="text-xl font-semibold mt-4">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user' , $post->user) }}" class="font-semibold text-blue-600 hover:text-blue-800">
            {{ $post->user->name }}
        </a>
    </div>

    @if($full)
    <div class="text-sm">
        <span>{{ $post->body }}</span>
    </div>
    @else
    <div class="text-sm">
        <p class="text-gray-700">{{ Str::words($post->body,15) }}</p>
        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">Read more &rarr;</a>
    </div>
    @endif

    <div class="flex items-center justify-end gap-4 mt-6">{{ $slot }}</div>

</div>
