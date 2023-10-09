<x-layout>
    <h1>{{$article->title}}</h1>
    <h2>{{$article->author->firstname . ' ' . $article->author->lastname}}</h2>
    <section>
        <x-card :item="$article"/>
        <a href="{{route('article.edit', ['article' => $article['id']])}}" class="btn btn-primary">Modifica {{$article->title}}</a>
        <form action="{{route('article.destroy',$article)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-danger" type="submit">Elimina {{$article->title}}</button>
        </form>
        <ul>
            @foreach ($article->categories as $category)
                <li>{{$category->name}}</li>
            @endforeach
        </ul>
    </section>
</x-layout>