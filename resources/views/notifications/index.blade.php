<x-app-layout>
    <h2>Your Notifications</h2>

    @if($notifications->isEmpty())
        <p>No new notifications</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li>
                    {{ $notification->data['message'] ?? 'No message available' }}
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>



