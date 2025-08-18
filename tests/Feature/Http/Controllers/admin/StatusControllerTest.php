<?php

namespace Tests\Feature\Http\Controllers\admin;

use App\Http\Controllers\admin\StatusController;
use App\Models\Status;
use App\Services\Contracts\StatusContract as StatusServiceContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private $statusService;
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();

        // Мокаем сервис
        $this->statusService = Mockery::mock(StatusServiceContract::class);

        // Создаем контроллер с моком
        $this->controller = new StatusController($this->statusService);
    }

    public function test_index_returns_view_with_paginated_statuses()
    {
        // Подготавливаем моковые данные
        $statuses = Status::factory(3)->make();

        // Мокаем возврат LengthAwarePaginator
        $paginator = new LengthAwarePaginator(
            $statuses,
            3, // total items
            15, // per page
            1, // current page
            ['path' => '/admin/statuses']
        );

        $this->statusService->shouldReceive('getPaginated')->andReturn($paginator);

        // Выполняем GET-запрос к маршруту
        $response = $this->get(route('admin.statuses.index'));

        // Проверяем, что возвращается правильный шаблон
        $response->assertViewIs('admin.statuses.index');

        // Проверяем, что переданный пагинатор имеет ожидаемые значения
        $response->assertViewHas('statuses', function ($actual) use ($paginator) {
            return
                !($actual->total() === $paginator->total() &&
                $actual->currentPage() === $paginator->currentPage() &&
                $actual->perPage() === $paginator->perPage() &&
                $actual->items() === $paginator->items());
        });
    }

    public function test_create_returns_create_view()
    {
        $response = $this->get(route('admin.statuses.create'));

        $response->assertViewIs('admin.statuses.create');
    }

    public function test_store_creates_new_status_and_redirects()
    {
        $validated = ['letter' => 'Н', 'color' => '#aabbcc'];

        $this->statusService->shouldReceive('store')->with($validated)->andReturnTrue();

        $response = $this->post(route('admin.statuses.store'), $validated);

        $response->assertRedirect(route('admin.statuses.index'))
            ->assertSessionHas('success');
    }

    public function test_edit_returns_edit_view_with_status()
    {
        // Создаём модель и сохраняем её в БД
        $status = Status::factory()->create();

        // Генерируем маршрут с правильным параметром
        $response = $this->get(route('admin.statuses.edit', ['status' => $status]));

        // Проверяем, что используется правильный шаблон
        $response->assertViewIs('admin.statuses.edit');

        // Проверяем, что модель передана в шаблон
        $response->assertViewHas('status', $status);
    }

    public function test_update_updates_status_and_redirects()
    {
        // Создаём и сохраняем модель в БД
        $status = Status::factory()->create(['id' => 1]);
        $validated = $status->toArray();

        $this->statusService->shouldReceive('updateStatus')->with($validated, 1)->andReturnTrue();

        $response = $this->put(route('admin.statuses.update', $status), $validated);

        $response->assertRedirect(route('admin.statuses.index'))
            ->assertSessionHas('success');
    }

    public function test_destroy_deletes_status_and_redirects()
    {
        // Создаём и сохраняем модель в БД
        $status = Status::factory()->create(['id' => 1]);

        // Мокаем сервис
        $this->statusService->shouldReceive('destroy')->with($status->id)->andReturnTrue();

        // Выполняем DELETE-запрос
        $response = $this->delete(route('admin.statuses.destroy', $status));

        // Проверяем редирект и сообщение в сессии
        $response->assertRedirect(route('admin.statuses.index'))
            ->assertSessionHas('success');
    }
}
