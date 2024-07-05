<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'lesson_id',
        'lesson_priority',
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
     * Обратная связь лекций и групп
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Обратная связь лекций и групп
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Получаем список лекций (учебный план) для конкретной группы
     */
    public function getAbout(int $id)
    {
        return Plan::select('topic')
            ->join('groups', 'groups.id', '=', 'plans.group_id')
            ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
            ->where('groups.id', $id)
            ->orderBy('lesson_priority')
            //->orderBy('lesson_priority', 'DESC') // обратная сортировка
            //->groupBy('topic', 'lesson_priority') // distinct
            ->get();
    }

    /**
     * Выполняем изменение списка лекций
     */
    public function changePlan(object $request)
    {
        return Plan::whereId($request->id)
            ->update($request->all());
    }
}