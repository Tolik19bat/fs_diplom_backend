<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Возвращает список всех фильмов.
     */
    public function index()
    {
        // Извлекаем и возвращаем все записи из таблицы movies
        return Movie::all();
    }

    /**
     * Сохраняет новый фильм в базе данных.
     */
    public function store(MovieRequest $request)
    {
        // Проверяем наличие файла и его валидность
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Сохраняем файл в директорию posters и получаем путь к файлу
            $path = Storage::disk('public')->putFile('posters', $request->file('file'));
            // Получаем валидированные данные из запроса
            $input = $request->validated();
            // Удаляем файл из массива ввода
            unset($input['file']);
            // Добавляем URL постера к данным
            $input['poster_url'] = asset("storage/$path");
        } else {
            // Получаем валидированные данные без файла
            $input = $request->validated();
        }

        // Создаём запись фильма и возвращаем её
        return Movie::query()->create($input);
    }

    /**
     * Возвращает данные конкретного фильма по ID.
     */
    public function show(int $MovieId)
    {
        // Находим фильм по ID или выбрасываем исключение, если не найден
        return Movie::query()->findOrFail($MovieId);
    }

    /**
     * Обновляет данные фильма.
     */
    public function update(MovieRequest $request, int $movieId)
    {
        // Проверяем наличие файла и его валидность
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Сохраняем файл и обновляем путь к нему
            $path = Storage::disk('public')->putFile('posters', $request->file('file'));
            $input = $request->validated();
            unset($input['file']);
            $input['poster_url'] = asset("storage/$path");
        } else {
            $input = $request->validated();
        }

        // Обновляем фильм с новыми данными
        $movie = Movie::query()->findOrFail($movieId);
        $movie->fill($input);

        // Сохраняем изменения и возвращаем результат
        return $movie->save();
    }

    /**
     * Удаляет фильм и связанные сеансы.
     */
    public function destroy(int $MovieId)
    {
        $movie = Movie::query()->findOrFail($MovieId);
        $seances = $movie->seances();
        $seances->delete(); // Удаляем все сеансы, связанные с фильмом
        if ($movie->delete()) {
            return response(null, 204); // Возвращаем успешный ответ
        }
        return null;
    }

    /**
     * Возвращает фильмы, которые идут в заданную дату.
     */
    public function getByDate(string $date)
    {
        // Извлекаем фильмы, у которых дата начала проката меньше или равна указанной дате,
        // а дата окончания проката больше или равна указанной дате.
        // Также проверяем, что у фильма есть связанные сеансы.
        $movies = Movie::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->has('seances')
            ->get();

        // Извлекаем залы, в которых есть сеансы, и где включены продажи билетов.
        $halls = Hall::has('seances')->where('sales', true)->get();

        // Создаём пустой массив для доступных фильмов.
        $availableMovies = [];

        // Перебираем все найденные фильмы.
        foreach ($movies as $movie) {
            // Перебираем все залы с продажей билетов.
            foreach ($halls as $hall) {
                // Проверяем, есть ли у текущего фильма сеансы в данном зале.
                if ($movie->seances()->where('hall_id', $hall->id)->exists()) {
                    // Если фильм ещё не добавлен в массив доступных фильмов, добавляем его.
                    if (!in_array($movie, $availableMovies)) {
                        $availableMovies[] = $movie;
                    }
                }
            }
        }
        // Возвращаем список доступных фильмов.
        return $availableMovies;
    }
}