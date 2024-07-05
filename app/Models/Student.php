<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'group_id',
    ];

    /**
     * Получаем данные об объекте запроса + связанные с ним данные из соседних таблиц
     */
    public function getAbout(int $id)
    {
        return Student::select('name', 'email', 'title', 'topic')
            ->where('students.id', $id)
            ->join('groups', 'students.group_id', '=', 'groups.id')
            ->join('plans', 'plans.group_id', '=', 'students.group_id')
            ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
            ->groupBy('name', 'title', 'topic', 'email')
            ->get();
    }
}