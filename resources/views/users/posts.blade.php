<x-layout>

    <h1 class="text-2xl text-center font-bold mb-6">{{$user->name}}'s Posts  &#9830; {{$posts->total()}}</h1>
    {{-- User's Post --}}


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>
<div class="mt-6">
    {{ $posts->links('pagination::tailwind') }}
</div>

</x-layout>
