<x-layout>
    <section>
        <form action="{{route('author.update',$author)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <input type="text" value="{{$author->firstname}}" class="form-control" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Cognome</label>
                <input type="text" value="{{$author->lastname}}" class="form-control" name="lastname">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Data di nascita</label>
                <input type="date" value="{{$author->birthday}}" class="form-control" name="birthday">
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Autore</label>
                <select name="author_id" id="">
                @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{$author->firstname . ' ' . $author->lastname}}</option>  
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</x-layout>