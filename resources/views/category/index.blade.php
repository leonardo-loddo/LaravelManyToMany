<x-layout>
    <section>
        <div class="container">
            <a class="" href="{{route('category.create')}}">Crea Categoria</a>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gap-3">
                @forelse ($categories as $category)
                <div class="d-flex m-5 border p-3 flex-column align-items-center rounded">
                    <a href="{{route('category.show', compact('category'))}}">{{$category->name}}</a>
                    <a href="{{route('category.edit', compact('category'))}}" class="btn">Modifica</a>
                    <form action="{{route('category.destroy',$category)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-danger" type="submit">Elimina {{$category->name}}</button>
                    </form>                    
                </div>
                @empty
                <span class="text-center">Nessuna Categoria</span>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>