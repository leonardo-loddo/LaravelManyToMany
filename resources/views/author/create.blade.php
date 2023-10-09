<x-layout>
    <section>
        <form action="{{route('author.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="firstname" class="form-label">Nome</label>
                <input type="text" value="{{old('firstname')}}" class="form-control" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Cognome</label>
                <input type="text" value="{{old('lastname')}}" class="form-control" name="lastname">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Data di nascita</label>
                <input type="date" value="{{old('birthday')}}" class="form-control" name="birthday">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</x-layout>