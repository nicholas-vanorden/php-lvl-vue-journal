<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JournalEntryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->journalEntries()->with('tags');

        if ($request->has('tag')) {
            $tagNames = explode(',', $request->input('tag'));
            $query->whereHas('tags', function ($q) use ($tagNames) {
                $q->whereIn('name', $tagNames);
            });
        }

        return Inertia::render('Journal/Index', [
            'journalEntries' => $query->latest()->get(),
            'allTags' => Tag::all(),
            'selectedTag' => $request->input('tag'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Journal/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $journalEntry = Auth::user()->journalEntries()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $journalEntry->tags()->sync($tagIds);
        }

        return redirect()->route('journal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $journalEntry = Auth::user()->journalEntries()->with('tags')->findOrFail($id);
        $this->authorize('view', $journalEntry);
        return Inertia::render('Journal/Show', [
            'journalEntry' => $journalEntry,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $journalEntry = Auth::user()->journalEntries()->with('tags')->findOrFail($id);
        $this->authorize('update', $journalEntry);
        return Inertia::render('Journal/Edit', [
            'journalEntry' => $journalEntry,
            'allTags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $journalEntry = Auth::user()->journalEntries()->findOrFail($id);
        $this->authorize('update', $journalEntry);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $journalEntry->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $journalEntry->tags()->sync($tagIds);
        } else {
            $journalEntry->tags()->detach();
        }

        return redirect()->route('journal.show', $journalEntry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $journalEntry = Auth::user()->journalEntries()->findOrFail($id);
        $this->authorize('delete', $journalEntry);
        $journalEntry->delete();
        return redirect()->route('journal.index');
    }
}
