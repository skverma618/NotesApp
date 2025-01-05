<x-app-layout>
    <div class="note-container py-12">
        <!-- <a href="/note/create" class="new-note-btn"> -->
        <a href="{{route('note.create')}}" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            @foreach ($notes as $note)
            <div class="note">
                    <div class="note-body">
                        {{Str::words($note->note,"36")}}
                    </div>
                    <div class="note-buttons">
                        <a href="{{route('note.show', $note->id)}}" class="note-edit-button">View</a>
                        <a href="{{route('note.edit', $note)}}" class="note-edit-button">Edit</a>
                            <button class="note-delete-button">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
        {{$notes->links()}}
    </div>
</x-app-layout>