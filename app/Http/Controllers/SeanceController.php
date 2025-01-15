<?php

// Пространство имён для организации кода
namespace App\Http\Controllers;

// Подключаем необходимые модели и запрос
use App\Http\Requests\SeanceRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seance;

class SeanceController extends Controller
{
    /**
     * Возвращает список всех сеансов.
     */
    public function index()
    {
        // Извлекаем и возвращаем все записи из таблицы seances
        return Seance::all();
    }

    /**
     * Сохраняет новый сеанс в базе данных.
     */
    public function store(SeanceRequest $request)
    {
        // Создаём новый сеанс с использованием валидированных данных из запроса
        return Seance::query()->create($request->validated());
    }

    /**
     * Возвращает данные конкретного сеанса по ID.
     */
    public function show(int $seanceId)
    {
        // Извлекаем сеанс или выбрасываем исключение, если не найден
        $seance = Seance::query()->findOrFail($seanceId);
        // Находим связанный фильм
        $movie = Movie::query()->findOrFail($seance->movie_id);
        // Находим связанную залу
        $hall = Hall::query()->findOrFail($seance->hall_id);
        
        // Возвращаем массив с данными сеанса, фильма и залы
        return [
            'seance' => $seance,
            'movie' => $movie,
            'hall' => $hall,
        ];
    }

    /**
     * Обновляет данные сеанса.
     */
    public function update(SeanceRequest $request, int $seanceId)
    {
        // Извлекаем сеанс по ID
        $seance = Seance::query()->findOrFail($seanceId);
        // Обновляем сеанс с валидированными данными
        $seance->fill($request->validated());
        
        // Сохраняем изменения и возвращаем результат
        return $seance->save();
    }

    /**
     * Удаляет конкретный сеанс по ID.
     */
    public function destroy(int $seanceId)
    {
        // Извлекаем сеанс или выбрасываем исключение, если не найден
        $seance = Seance::query()->findOrFail($seanceId);
        
        // Удаляем сеанс и возвращаем успешный ответ, если удаление прошло успешно
        if ($seance->delete()) {
            return response(null, 204); // Успешный статус удаления
        }
        return null;
    }

    /**
     * Удаляет все сеансы для указанного фильма.
     */
    public function deleteAll(int $movieId)
    {
        // Извлекаем фильм и все его сеансы
        $seances = Movie::query()->findOrFail($movieId)->seances();
        
        // Удаляем все сеансы и возвращаем успешный ответ
        if ($seances->delete()) {
            return response(null, 204); // Успешный статус удаления
        }
        return null;
    }
}
