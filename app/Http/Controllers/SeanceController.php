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

        $seances = Seance::all();
        return response()->json($seances); // или return $seances;
    }

    /**
     * Сохраняет новый сеанс в базе данных.
     */
    public function store(SeanceRequest $request)
    {
        $seance = Seance::query()->create($request->validated());
        sleep(1); // Искусственная задержка перед отправкой ответа
        return response()->json($seance, 201);
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

        // Возвращаем массив с данными сеанса, фильма и залы + заголовки для отключения кеша
        return response()->json([
            'seance' => $seance,
            'movie' => $movie,
            'hall' => $hall,
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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

        // Удаляем все билеты, связанные с этим сеансом
        $seance->tickets()->delete();

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
        // Находим фильм и все его сеансы
        $movie = Movie::query()->findOrFail($movieId);
        $seances = $movie->seances;

        // Удаляем все билеты, связанные с этими сеансами
        foreach ($seances as $seance) {
            $seance->tickets()->delete(); // Удаляем билеты каждого сеанса
        }

        // Удаляем все сеансы
        if ($movie->seances()->delete()) {
            return response(null, 204); // Успешный статус удаления
        }
        return null;
    }
}
