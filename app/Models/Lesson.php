<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic',
        'description',
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
    ];

    /**
     * Cвязь со сводной таблице списка лекций
     */
    public function plan(): hasOne
    {
        return $this->hasOne(Plan::class);
    }


    /**
     * Получаем данные об объекте запроса + связанные с ним данные из соседних таблиц
     */
    public function getAbout(int $id)
    {
        return Plan::select('topic', 'description', 'title', 'name')
            ->where('lessons.id', $id)
            ->join('groups', 'groups.id', '=', 'plans.group_id')
            ->join('students', 'students.group_id', '=', 'plans.group_id')
            ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
            ->groupBy('name', 'title', 'topic', 'description')
            ->get();
    }
}