<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function show(Article $article)
    {

        // Renders a list of a resource

        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function index()
    {

        // Show s single resource

        return view('articles.index', [
            'articles' => Article::latest()->get()
        ]);
    }

    public function create()
    {

        // Shows a view to create a new resource
        return view('articles.create');
    }

    public function store()
    {

        // Persist the new resource
        Article::create($this->validateArticle());
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
            'body' => 'required'
        ]);
    }
}
