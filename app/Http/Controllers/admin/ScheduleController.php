<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedules\CreateRequest;
use App\Http\Requests\Schedules\EditRequest;
use App\Models\Schedule;
use App\Services\Contracts\ScheduleContract as ScheduleServiceContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

final class ScheduleController extends Controller
{
    public function __construct(
        private readonly ScheduleServiceContract $scheduleService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $schedules = $this->scheduleService->getPaginated();

        return view('admin.schedules.index', [
            'schedules' => $schedules['data']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.schedules.create');
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
        $result = $this->scheduleService->store($validated);

        if ($result) {
//            return redirect()->route('admin.schedules.index')
//                ->with('success', __('messages.admin.schedules.create.success'));
            return redirect()->back()
                ->with('success', __('messages.admin.schedules.create.success'));
        }

        return back()->with('error', __('messages.admin.schedules.create.fail'));
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
    public function edit(Schedule $schedule): View
    {
        return view('admin.schedules.edit', ['schedule' => $schedule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditRequest $request
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function update(EditRequest $request, Schedule $schedule): RedirectResponse
    {
        $schedule = $schedule->fill($request->validated());

        if ($schedule->save()) {
            return redirect()->route('admin.schedules.index', ['page' => 2])
                ->with('success', __('messages.admin.schedules.update.success'));
        }

        return back()->with('error', __('messages.admin.schedules.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function destroy(Schedule $schedule): RedirectResponse
    {
        $result = $this->scheduleService->destroy($schedule->id);

        if ($result) {
            return redirect()->back()
                ->with('success', __('messages.admin.schedules.destroy.success'));
        }

        return back()->with('error', __('messages.admin.schedules.destroy.fail'));
    }
}
