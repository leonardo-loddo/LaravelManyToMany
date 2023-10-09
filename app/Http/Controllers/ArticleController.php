<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }
    public function show(Article $article){
        return view('article.show', compact('article'));
    }
    public function create(){
        $authors = Author::all();
        $categories = Category::all();
        return view('article.create', compact('authors', 'categories'));
    }
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
    public function edit(Article $article){
        $authors = Author::all();
        $categories = Category::all();
        return view('article.edit', compact('authors', 'categories'));
    }
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
    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Libro Eliminato');
    }
}
