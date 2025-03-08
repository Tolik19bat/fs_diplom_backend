<?php

namespace App\Http\Controllers;

use App\Http\Requests\PricesHallRequest;
use App\Http\Requests\SalesRequest;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use App\Http\Requests\HallRequest;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Hall::all(); //коллекция залов
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallRequest $request)
    {
        return Hall::query()->create($request->validated()); //создать зал
    }

    /**
     * Display the specified resource.
     */
    public function show(int $hallId)
    {
        return Hall::query()->findOrFail($hallId); //показать зал
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallRequest $request, int $hallId) //обновить зал
    {
        $hall = Hall::query()->findOrFail($hallId); //Находим зал по ID  
        $hall->fill($request->validated); //Заполняем поля зала данными из запроса  
        return $hall->save(); //Сохраняем изменения в базе данных
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $hallId) // Удалить зал и сеансы по id  
    {
        // Ищем зал по идентификатору $hallId. Если зал не найден, будет выброшено исключение.  
        $hall = Hall::query()->findOrFail($hallId);

        // Получаем все сеансы, связанные с найденным залом и удаляем.  
        $hall->seances()->delete();

        // Удаляем все места из базы данных.  
        $hall->chairs()->delete();

        // Удаляем сам зал из базы данных. Если удаление успешно, возвращаем код состояния 204 (No Content).  
        if ($hall->delete()) {
            return response(null, 204);
        }

        // Если по какой-то причине зал не удалось удалить, возвращаем null.  
        return null;
    }

    public function updatePrices(PricesHallRequest $request, int $hallId)
    {
        // Ищем зал по идентификатору $hallId. Если зал не найден, будет выброшено исключение.  
        $hall = Hall::query()->findOrFail($hallId);

        // Заполняем модель залa данными из обрабатываемого запроса, которые были предварительно валидированы.  
        $hall->fill($request->validated());

        // Сохраняем изменения в базе данных и возвращаем результат сохранения (успешно или нет).  
        return $hall->save();
    }

    public function getSeances(int $hallId, int|null $movieId = null) //получить фильм в сеансе
    {
        if (!$movieId) { //если id фильма нет 
            return Hall::query()->findOrFail($hallId)->seances()->get(); //показать все сеансы
        }
        return Hall::query()->findOrFail($hallId)->seances()->where('movie_id', $movieId)->get(); //показать выбранный фильм в текущем сеансе
    }

    public function getChairs(string|int $hallId) //получаем места в зале
    {
        return Hall::query()->findOrFail((int) $hallId)->chairs()->get(); //коллекция стульев в зале
    }

    public function setSales(SalesRequest $request, int $hallId) // 
    {
        $hall = Hall::query()->findOrFail($hallId); // Ищем зал по ID  
        $hall->fill($request->validated()); // Заполняем свойства зала данными из запроса  
        return $hall->save(); // Сохраняем изменения в базе данных  
    }

    public function getSeancesAvailable() {
        $halls = Hall::has('seances')->where('sales', true)->get(); // Получаем залы, у которых есть сеансы 
        return $halls; // Возвращаем список залов
    }

}
