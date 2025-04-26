<x-layout>
    <h1 class="text-2xl font-bold mb-6">
        Welcome {{ auth()->user()->name }} you have {{ $posts->total() }} posts
    </h1>



        <h1 class="text-xl font-bold mb-2">Create a new post</h1>

        <p class="mb-4">
            Welcome to your dashboard. Here you can manage your posts and settings.
        </p>


        {{-- Create a post --}}
        <div class="mb-4">
               {{-- Session Messages --}}
         @if (session('success'))
         <x-flashMsg msg="{{ session('success') }}" />
     @elseif (session('delete'))
         <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
     @endif

  {{-- Create Post --}}
        <form action="{{ route('posts.store') }}" method="post"  enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
             {{-- Post Title --}}
             <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">

                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Post Content</label>

                <textarea name="body" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>

                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Image --}}
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Post Image</label>
                <input type="file" name="image" id="image"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror">

                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Create Post</button>
        </form>
    </div>

    {{-- User Posts --}}
    <div class="mt-8">
        <h1 class="text-xl font-bold mb-2">Your Posts</h1>
        <p class="mb-4">
            Here are the posts you have created.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($posts as $post)
                <x-postCard :post="$post" >
                    <div class="flex justify-end space-x-2 mt-4">
                        {{-- Update Post --}}
                        <a href="{{ route('posts.edit', $post) }}" class="bg-green-500 text-white text-xs px-4 py-2 rounded hover:bg-green-600 transition">Update</a>

                        {{-- Delete Post --}}
                        <form action="{{ route('posts.destroy', $post) }}" method="post" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs px-5 py-2 rounded hover:bg-red-600 transition">Delete</button>
                        </form>
                    </div>
                    {{-- Edit Post --}}




                </x-postCard>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links('pagination::tailwind') }}
        </div>

    </div>
</x-layout>
