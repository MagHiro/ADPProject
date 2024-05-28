<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use App\Services\Lot\LotServiceStrategy;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $lots = Lot::where('user_id', Auth::id())
            ->with('images')
            ->orderByDesc('updated_at')
            ->paginate(6);
        return view('lots.all', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LotServiceStrategy $service
     * @return RedirectResponse
     */
    public function store(LotServiceStrategy $service)
    {
        $service->execute();
        return redirect()->route('lots.index')->with('success', 'Lot created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Lot $lot
     * @return Application|Factory|View
     */
    public function show(Lot $lot)
    {
        Gate::authorize('show-lot', $lot);
        return view('lots.one', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Lot $lot
     * @return Application|Factory|View
     */
    public function edit(Lot $lot)
    {
        $categories = Category::all();
        Gate::authorize('edit-lot', $lot);
        return view('lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LotServiceStrategy $service
     * @param int $id
     * @return RedirectResponse
     */
    public function update(LotServiceStrategy $service, int $id)
    {
        $service->execute($id);
        return redirect()->route('lots.show', $id)->with('success', 'Lot updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LotServiceStrategy $service
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(LotServiceStrategy $service, int $id)
    {
        $service->execute($id);
        return redirect()->route('lots.index')->with('success', 'Lot deleted successfully.');
    }
}
