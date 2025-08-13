<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statuses\CreateRequest;
use App\Http\Requests\Statuses\EditRequest;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Services\Contracts\StatusContract as StatusServiceContract;

final class StatusController extends Controller
{
    public function __construct(
        private readonly StatusServiceContract $statusService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.statuses.index', [
            'statuses' => $this->statusService->getPaginated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $status = $this->statusService->store($validated);

        if ($status) {
            return redirect()->route('admin.statuses.index')
                ->with('success', __('messages.admin.statuses.create.success'));
        }

        return back()->with('error', __('messages.admin.statuses.create.fail'));
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
    public function edit(Status $status): View
    {
        return view('admin.statuses.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Status $status
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Status $status): RedirectResponse
    {
        $status = $status->fill($request->validated());

        if ($status->save()) {
            return redirect()->route('admin.statuses.index')
                ->with('success', __('messages.admin.statuses.update.success'));
        }

        return back()->with('error', __('messages.admin.statuses.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     *
     * @return RedirectResponse
     */
    public function destroy(Status $status): RedirectResponse
    {
        $status = $this->statusService->destroy($status->id);

        if ($status) {
            return redirect()->route('admin.statuses.index')
                ->with('success', __('messages.admin.statuses.destroy.success'));
        }

        return back()->with('error', __('messages.admin.statuses.destroy.fail'));
    }
}
