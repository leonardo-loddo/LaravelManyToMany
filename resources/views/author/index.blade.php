<x-layout>
    <section>
        <a class="" href="{{route('author.create')}}">Crea Autore</a>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gap-3">
                @forelse ($authors as $author)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$author->firstname}}</h5>
                        <p class="card-text">{{$author->lastname}}</p>
                        <p class="card-text">{{$author->birthday}}</p>
                        <a href="{{route('author.show', ['author' => $author['id']])}}" class="btn btn-primary">Leggi {{$author->title}}</a>
                    </div>
                </div>
                @empty
                <span class="text-center">Nessun Autore</span>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>