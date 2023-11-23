<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Chat</title>
</head>
<body class="bg-amber-100">

    <div class="chat bg-white mx-auto mt-24 w-3/4 py-56 border border-black rounded">
        @forelse ($chats as $chat)
            <em>{{ $chat->pseudo }}</em> : {{ $chat->message}} <br>
        @empty
        @endforelse
    </div>

    <div class="max-w-3xl button flex mx-auto gap-4 mt-1 w-full">
        <form action="{{ route('chat.store') }}" method="post">
            @csrf

            <input type="text" placeholder="Message" name="message" class="bg-red-500 p-2 border border-black rounded" required>
            <input type="text" placeholder="Pseudo" name="pseudo" class="bg-red-500 p-2 border border-black rounded" value="{{ old('pseudo') }}"required>

            <input type="submit" class="submit bg-lime-500 px-2 py-2 border border-black rounded">
        </form>
    </div>

</body>
</html>
