<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Сохраняет новый билет в базе данных.
     */
    public function store(TicketRequest $request)
    {
        // Проверяем, существует ли уже билет с указанной датой, ID сеанса и ID места
        if (Ticket::query()
            ->where('date', $request->get('date')) // Сравниваем дату
            ->where('seance_id', $request->get('seance_id')) // Сравниваем ID сеанса
            ->where('chair_id', $request->get('chair_id')) // Сравниваем ID места
            ->exists()) { // Проверяем, есть ли такие записи
            // Если билет уже существует, возвращаем ответ с сообщением и статусом 400
            return response('билет уже есть в базе данных', 400);
        }

        // Создаём новый билет с валидированными данными и сохраняем его в базе
        return Ticket::query()->create($request->validated());
    }
}
