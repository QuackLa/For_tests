<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Lesson;

use App\Http\Requests\Lesson\LessonAboutRequest;
use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Http\Requests\Lesson\LessonUpdateRequest;
use App\Http\Requests\Lesson\LessonDeleteRequest;

class LessonsController extends CollegeController
{
    // Для модели лекций
    private $modelLesson;

    /**
     * Конструктор класса
     */
    public function __construct(Lesson $lesson)
    {
        $this->modelLesson = $lesson;
    }

    /**
     * Весь список лекций
     */
    public function list()
    {
        $list = $this->modelLesson->paginate(10);

        return response()->json([
            'data' => $list->all(),
        ]);
    }

    /**
     * Информация о конкретной лекциии
     */
    public function about(LessonAboutRequest $request)
    {
        $lesson = $this->modelLesson->getAbout($request->id);

        return response()->json([
            'data' => $lesson,
        ]);
    }

    /**
     * Создать запись о лекции
     */
    public function create(LessonCreateRequest $request)
    {
        $lesson = $this->modelLesson->create($request->all());

        return response()->json($lesson);
    }

    /**
     * Изменить запись о лекции
     */
    public function update(LessonUpdateRequest $request)
    {
        $lesson = $this->modelLesson->whereId($request->id)->update($request->all());

        return response()->json($lesson);
    }

    /**
     * Удалить запись о лекции
     */
    public function delete(LessonDeleteRequest $request)
    {
        $lesson = $this->modelLesson->whereId($request->id)->delete();

        return response()->json($lesson);
    }
}