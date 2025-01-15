<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChairRequest;
use App\Http\Requests\UpdateChairsByHallRequest;
use App\Http\Requests\UpdateChairsByIdRequest;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Chair;

class ChairController extends Controller
{
    /**
     * Сохраняет новый ресурс (стулья) в хранилище.
     */
    public function store(ChairRequest $request)
    {
        $chairs = $request->validated()['chairs']; // Получаем и валидируем данные о стульях
        $array = [];

        // Перебираем массив с данными о стульях
        foreach ($chairs as $chair) {
            $item = [
                'hall_id' => $chair['hall_id'], // Идентификатор зала
                'row' => $chair['row'],         // Номер ряда
                'place' => $chair['place'],     // Номер места
                'type' => $chair['type'],       // Тип стула
            ];
            $array[] = Chair::query()->create($item); // Создаем запись для каждого стула
        }

        return $array; // Возвращаем созданные стулья
    }

    /**
     * Показывает информацию о конкретном ресурсе (стуле).
     */
    public function show(int $CharId)
    {
        return Chair::query()->findOrFail($CharId); // Ищем стул по ID или выбрасываем 404
    }

    /**
     * Обновляет ресурс по идентификатору зала.
     */
    public function update(UpdateChairsByHallRequest $request, int $hallId)
    {
        Hall::query()->findOrFail($hallId)->chairs()->delete(); // Удаляем существующие стулья для данного зала
        $chairs = $request->validated()['chairs']; // Валидируем входные данные
        $array = [];

        // Создаем новые записи стульев
        foreach ($chairs as $chair) {
            $item = [
                'hall_id' => $hallId,
                'row' => $chair['row'],
                'place' => $chair['place'],
                'type' => $chair['type'],
            ];
            $array[] = Chair::query()->create($item);
        }

        return $array; // Возвращаем обновленный список стульев
    }

    /**
     * Обновляет стулья по их идентификаторам.
     */
    public function updateChairs(UpdateChairsByIdRequest $request)
    {
        $chairs = $request->validated()['chairs']; // Валидируем массив стульев
        $array = [];

        foreach ($chairs as $chair) {
            $currentChair = Chair::query()->findOrFail($chair['id']); // Находим стул по ID
            $currentChair->fill($chair); // Обновляем поля стула
            $array[] = $currentChair->save(); // Сохраняем изменения
        }

        return $array; // Возвращаем массив с результатами
    }

    /**
     * Удаляет стулья для указанного зала.
     */
    public function destroy($hall_id)
    {
        if (Chair::query()->where('hall_id', $hall_id)->doesntExist()) {
            return abort(404); // Если стулья не найдены, возвращаем 404
        }
        Chair::query()->where('hall_id', $hall_id)->delete(); // Удаляем стулья для данного зала
    }

    /**
     * Получает ID стульев по ID сеанса и дате.
     */
    public function getBySeanceIdAndDate(int $SeanceId, string $Date)
    {
        return Seance::query()
            ->findOrFail($SeanceId) // Ищем сеанс по ID или выбрасываем 404
            ->tickets()
            ->where('date', $Date) // Фильтруем по дате
            ->pluck('chair_id') // Получаем только ID стульев
            ->toArray(); // Преобразуем результат в массив
    }
}
