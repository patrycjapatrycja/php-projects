<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1 pr-8">
                        <h1 class="text-5xl">{{ $user->name }}</h1>
                        <div class="mt-8">
                            @forelse($posts as $post)
                                <x-post-item :post="$post" />
                            @empty
                                <div class="text-center text-gray-400">No Posts Found</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <x-follow-container :user="$user" class="w-[320px] border-l pl-8">
                        <div class="flex flex-col items-center text-center">
                        <x-user-avatar :user="$user" size="w-32 h-32"/>
                        <h3 class="mt-2">{{ $user->name }}</h3>
                        <p class="text-gray-500"><span x-text="followersCount"></span> followers</p>
                        <p>{{ $user->bio }}</p>
                        @if(auth()->user() && auth()->user()->id !== $user->id)
                            <div>
                                <button @click="follow()" class="rounded-full px-4 py-2 text-white mt-4"
                                x-text="following ? 'Unfollow' : 'Follow'"
                                :class="following ? 'bg-red-600' : 'bg-emerald-600'">
                                </button>
                            </div>
                        @endif
                        </div>
                    </x-follow-container> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
