<x-layout>
    <section>
        <form action="{{route('category.update',$category)}}" method="POST" enctype="multipart/form-data">
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
                <label for="name" class="form-label">Nome Categoria</label>
                <input type="text" value="{{old('name')}}" class="form-control" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</x-layout>