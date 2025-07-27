<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Divisions\CreateRequest;
use App\Http\Requests\Divisions\EditRequest;
use App\Models\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $divisions = Division::query()
            ->paginate(config('pagination.admin.divisions'));

        return view('admin.divisions.index', [
            'divisions' => $divisions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $division = new Division(
            $request->validated()
        );

        if ($division->save()) {
            return redirect()->route('admin.divisions.index')
                ->with('success', __('messages.admin.divisions.create.success'));
        }

        return back()->with('error', __('messages.admin.divisions.create.fail'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division): View
    {
        return view('admin.divisions.edit', ['division' => $division]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Division $division
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Division $division): RedirectResponse
    {
        $division = $division->fill($request->validated());

        if ($division->save()) {
            return redirect()->route('admin.divisions.index')
                ->with('success', __('messages.admin.divisions.update.success'));
        }

        return back()->with('error', __('messages.admin.divisions.update.fail'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Division $division
     *
     * @return RedirectResponse
     */
    public function destroy(Division $division): RedirectResponse
    {
        $division = Division::destroy($division->id);

        if ($division) {
            return redirect()->route('admin.divisions.index')
                ->with('success', __('messages.admin.divisions.destroy.success'));
        }

        return back()->with('error', __('messages.admin.divisions.destroy.fail'));
    }
}
