<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Student;

use App\Http\Requests\Student\StudentAboutRequest;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Http\Requests\Student\StudentDeleteRequest;


class StudentsController extends CollegeController
{
    // Для модели
    private $modelStudent;

    /**
     * Конструктор класса
     */
    public function __construct(Student $student)
    {
        $this->modelStudent = $student;
    }

    /**
     * Весь список студентов
     */
    public function list()
    {
        $list = $this->modelStudent->paginate(10);

        return response()->json([
            'data' => $list->all(),
        ]);
    }

    /**
     * Информация о конкретном студенте
     */
    public function about(StudentAboutRequest $request)
    {
        $student = $this->modelStudent->getAbout($request->id);

        return response()->json([
            'data' => $student,
        ]);
    }

    /**
     * Создать запись о студенте
     */
    public function create(StudentCreateRequest $request)
    {
        $student = $this->modelStudent->create($request->all());

        return response()->json($student);
    }

    /**
     * Изменить запись о студенте
     */
    public function update(StudentUpdateRequest $request)
    {
        $student = $this->modelStudent->whereId($request->id)
            ->update([
                'name' => $request->name,
                'group_id' =>$request->group_id
            ]);

        return response()->json($student);
    }

    /**
     * Удалить запись о студенте
     */
    public function delete(StudentDeleteRequest $request)
    {
        $student = $this->modelStudent->whereId($request->id)->delete($request->id);

        return response()->json($student);
    }
}