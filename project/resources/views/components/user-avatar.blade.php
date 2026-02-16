@props(['user', 'size' => 'w-12 h-12'])

<div class="{{ $size }}">
    @if($user->image)
        <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="rounded-full object-cover">
    @else
        <img src="https://upload.wikimedia.org/wikipedia/en/b/b1/Portrait_placeholder.png" alt="dummy avatar" class="rounded-full object-cover">
    @endif
</div>