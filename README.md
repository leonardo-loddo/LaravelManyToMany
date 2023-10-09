devo creare il crud di category
    php artisan make:model Category -mcrR  

creo le rotte
    //category ROUTES
    Route::resource('category', CategoryController::class);

creo le viste

modifico la migrazione aggiungendo la stringa name

mappo il dato name nel fillable del modello Category

completo le funzioni nel CategoryController

modifico le viste duplicate in modo da farle funzionare con category

modifico le request mettendo nelle rules il campo name

creo la tabella pivot per la relazione molti a molti (i nomi dei modelli devono essere in ordine alfabetico)
    php artisan make:migration create_article_category_table

vado nella migrazione e modifico la funzione up
    public function up(): void
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->id();

            //creo le colonne con chiavi esterne
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('category_id');
            //creo le relazioni
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }

modifico la funzione down
    public function down(): void
    {
        Schema::table('article_category', function (Blueprint $table) {
            //elimino le relazioni
            $table->dropForeign(['article_id', 'category_id']);
            //elimino le colonne
            $table->dropColumn(['article_id', 'category_id']);
        });
    }

php artisan migrate

vado nel modello Article e creo la funzione categories nel quale return utilizzo una fusione dei metodi belongsTo() e hasMany() ovvero belongsToMany()
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
stessa cosa per articles nel modello Category
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

nell'articleController nella funzione create passo anche tutte le categorie in modo da mostrale come opzioni selezionabili durante la creazione dell'articolo
    public function create(){
        $authors = Author::all();
        $categories = Category::all();
        return view('article.create', compact('authors', 'categories'));
    }
stessa cosa in edit

nella vista article.create genero una checkbox per ogni categoria esistente, in questo modo verranno passate all'interno di un array gli id di tutte le categorie selezionate
    <div class="form-check">
        @foreach ($categories as $category)
        <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="{{'category'.$category->id}}" name="categories[]">
        <label class="form-check-label" for="{{'category'.$category->id}}">
            {{$category->name}}
        </label>
        @endforeach
    </div>

nella store di articleController collego le categorie selezionate durante la creazione
    public function store(ArticleStoreRequest $request){
        //$extension_name = $request->file('image')->getClientOriginalExtension();

        $path_image = '';
        if ($request->hasFile('image')){
            $file_name = $request->file('image')->getClientOriginalName();
            $path_image = $request->file('image')->storeAs('public/image', $file_name);
        }
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path_image,
            'author_id' => $request->author_id,
        ]);
        //COLLEGO LE CATEGORIE ALL'ARTICOLO
        $article->categories()->attach($request->categories);

        return redirect()->route('article.index')->with('success', 'Libro Caricato');
    }

nella vista article.edit metto le checkbox di prima ma faccio un controllo in modo da mettere le categorie associate attualmente spuntate di defaault
    <div class="form-check">
        @foreach ($categories as $category)
        <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="{{'category'.$category->id}}" name="categories[]
        @if($article->categories->contains($category->id)) checked @endif">
        <label class="form-check-label" for="{{'category'.$category->id}}">
            {{$category->name}}
        </label>
        @endforeach
    </div>

nella funzione update scollego tutte le categorie collegate precedentemente e collego le categorie slezionate nel form di modifica
    public function update(ArticleUpdateRequest $request, Article $article){
        $path_image = $article->image;//inserisce l'immagine precedente

        if ($request->hasFile('image')){
            $file_name = $request->file('image')->getClientOriginalName();
            $path_image = $request->file('image')->storeAs('public/image', $file_name);
        }
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path_image,
            'author_id' => $request->author_id,
        ]);
        //scollego le categorie selezionate precedentemente dall'articolo
        $article->categories()->detach();        
        //COLLEGO LE nuove CATEGORIE ALL'ARTICOLO
        $article->categories()->attach($request->categories);

        return redirect()->route('article.index')->with('success', 'Libro Aggiornato');
    }

nella vista article.show implemento un foreach che mostra le categorie assegnate all'articolo
    <ul>
        @foreach ($article->categories as $category)
            <li>{{$category->name}}</li>
        @endforeach
    </ul>