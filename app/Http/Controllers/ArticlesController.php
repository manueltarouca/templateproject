<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        // Renders a list of a resource

        if (request('tag')){
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }
        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article)
    {
        // Show s single resource

        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function create()
    {
        // Shows a view to create a new resource

        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store()
    {
        // Persist the new resource

        $this->validateArticle();
        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 2; // $auth()->id;
        $article->save();
        $article->tags()->attach(\request('tags'));
        return redirect(route('articles.index'));
    }

    public function edit(Article $article)
    {
        // Shows a view to edit an existing resource

        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        // Persist the edited resource

        $article->update($this->validateArticle());
        return redirect($article->path());
    }

    public function destroy()
    {
        // Delete the resource
    }

    /**
     * @return array
     */
    protected function validateArticle(): array
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }
}
