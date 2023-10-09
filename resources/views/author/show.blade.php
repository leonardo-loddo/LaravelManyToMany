<x-layout>
    <section>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$author->firstname}}</h5>
                <p class="card-text">{{$author->lastname}}</p>
                <p class="card-text">{{$author->birthday}}</p>
                <a href="{{route('author.show', ['author' => $author['id']])}}" class="btn btn-primary">Leggi {{$author->title}}</a>
            </div>
        </div>
        <a href="{{route('author.edit', ['author' => $author['id']])}}" class="btn btn-primary">Modifica {{$author->title}}</a>
        <form action="{{route('author.destroy',$author)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-danger" type="submit">Elimina {{$author->title}}</button>
        </form>
    </section>
</x-layout>