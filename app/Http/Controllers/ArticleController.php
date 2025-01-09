<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Article::class);

        $user = $request->user();

        if ($user->hasRole('writer')) {
            $articlesForEdit = Article::with(['writer', 'editor'])
                ->where('writer_id', $user->id)
                ->where('status', 'For Edit')
                ->get();

            $publishedArticles = Article::with('writer')
                ->where('writer_id', $user->id)
                ->where('status', 'Published')
                ->get();

        } elseif ($user->hasRole('editor')) {
            $articlesForEdit = Article::with(['writer', 'editor'])->where('status', 'For Edit')->get();
            $publishedArticles = Article::with(['writer', 'editor'])->where('status', 'Published')->get();
        }

        return Inertia::render('Articles/Index', [
            'role' => $user->roles->pluck('name')->first(),
            'articlesForEdit' => $articlesForEdit ?? [],
            'publishedArticles' => $publishedArticles ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Article::class);

        $companies = Company::where('status', 'Active')->get();

        return Inertia::render('Articles/Create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Article::class);

        $user = $request->user();

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title'      => 'required|string|max:255',
            'link'       => 'required|url',
            'date'       => 'required|date',
            'content'    => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 's3');
            $imageUrl = Storage::disk('s3')->url($path);
            Storage::disk('s3')->setVisibility($path, 'public');
        }

        $article = Article::create([
            'company_id' => $validated['company_id'],
            'image'      => $imageUrl ?? null,
            'title'      => $validated['title'],
            'link'       => $validated['link'],
            'date'       => $validated['date'],
            'content'    => $validated['content'],
            'writer_id'  => $user->id,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        $companies = Company::where('status', 'Active')->get();

        return Inertia::render('Articles/Edit', [
            'article' => $article,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {

        Gate::authorize('update', $article);

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title'      => 'required|string|max:255',
            'link'       => 'required|url',
            'date'       => 'required|date',
            'content'    => 'required|string',
        ]);

        // if ($request->hasFile('image')) {
        //     if ($article->image) {
        //         Storage::disk('s3')->delete($article->image);
        //     }
    
        //     // Upload the new image to S3
        //     $path = $request->file('image')->store('articles', 's3');
        //     Storage::disk('s3')->setVisibility($path, 'public');
        //     $validated['image'] = Storage::disk('s3')->url($path);
        // } else {
        //     $validated['image'] = $article->image;
        // }

        $article->update([
            'company_id' => $validated['company_id'],
            'title'      => $validated['title'],
            'link'       => $validated['link'],
            'date'       => $validated['date'],
            'content'    => $validated['content'],
            'editor_id'  => $request->user()->id,
        ]);

        return redirect()->route('articles.allmedia')
            ->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        if ($article->image) {
            Storage::disk('s3')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully!');
    }

    /**
     * Publish the specified article.
     */
    public function publish(Request $request, Article $article)
    {
        Gate::authorize('publish', $article);

        $user = $request->user();

        $article->update([
            'status'    => 'Published',
            'editor_id' => $user->id,
        ]);

        return redirect()->route('articles.allmedia')
            ->with('success', 'Article published successfully!');
    }

    /**
     * Display all articles for the All Media page.
     */
    public function allmedia(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('writer')) {
            $articles = Article::with(['writer', 'editor', 'company'])
                ->where('writer_id', $user->id)
                ->get();
        } elseif ($user->hasRole('editor')) {
            $articles = Article::with(['writer', 'editor', 'company'])->get();
        }

        return Inertia::render('Articles/AllMedia', [
            'role' => $user->roles->pluck('name')->first(),
            'articles' => $articles,
        ]);
    }
}
