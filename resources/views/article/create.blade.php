<x-layout>
    <section>
        <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
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
                <label for="title" class="form-label">Titolo Articolo</label>
                <input type="text" value="{{old('title')}}" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Corpo Articolo</label>
                <textarea name="body" id="" cols="30" rows="10">{{old('body')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Copertina</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Autore</label>
                <select name="author_id" id="">
                @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{$author->firstname . ' ' . $author->lastname}}</option>  
                @endforeach
                </select>
            </div>
            <div class="form-check">
                @foreach ($categories as $category)
                <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="{{'category'.$category->id}}" name="categories[]">
                <label class="form-check-label" for="{{'category'.$category->id}}">
                    {{$category->name}}
                </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</x-layout>