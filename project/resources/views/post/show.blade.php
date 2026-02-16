<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-5xl mb-8">{{ $post->title }}</h1>

                <!-- Avatar Section -->
                <div class="flex gap-3 h-12 items-center">
                    <x-user-avatar :user="$post->user"/>
                    <div>
                        <div class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">{{ $post->user->username }}</a>
                            @auth
                                &middot;
                                <x-follow-container :user="$post->user">
                                    <button @click="follow()" :class="following ? 'text-red-600' : 'text-emerald-600'" x-text="following ? 'Unfollow' : 'Follow'"></button>
                                </x-follow-container>
                            @endauth
                        </div>
                        <div class="text-gray-500 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>

                @if($post->user_id === auth()->id())
                <div>
                    <form class="inline-block" action="{{ route('post.edit', $post->slug) }}" method="get">
                        @csrf
                        <x-primary-button class="mt-4">
                            Edit Post
                        </x-primary-button>
                    </form>
                    <form class="inline-block" action="{{ route('post.destroy', $post) }}" method="post">
                        @csrf
                        @method('delete')
                        <x-danger-button>
                            Delete Post
                        </x-danger-button>
                    </form>
                </div>
                @endif

                <!-- Clap Section -->
                <x-clap-button :post="$post"></x-clap-button>

                <!-- Content Section -->
                <div class="flex flex-col gap-6 mt-8">
                    @if($post->image)
                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">
                    @endif
                    <p>{{ $post->content }}</p>
                </div>

                <!-- Category Section -->
                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-200 rounded-xl">{{ $post->category->name }}</span>
                </div>

                <x-clap-button :post="$post"></x-clap-button>
            </div>
        </div>
    </div>

</x-app-layout>
