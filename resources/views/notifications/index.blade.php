<x-layout>
    <div class="container">
        <h1>Notifications</h1>
        <ul class="list-group">
            @forelse ($notifications as $notification)
                <li class="list-group-item">
                    The user 
                    <a href="{{ route('profile.index', ['user' => $notification->data['follower_id']]) }}" 
                        class="text-blue-500 hover:underline">
                        {{ $notification->data['follower_name'] ?? 'You have a new notification.' }}
                    </a>
                    started following you
                    <span class="text-muted small">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @empty
                <li class="list-group-item">No notifications available.</li>
            @endforelse
        </ul>
    </div>
</x-layout>
