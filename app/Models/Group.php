<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'lesson_id',
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
     * Обратная связь группы со студентом
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Получаем данные об объекте запроса + связанные с ним данные из соседних таблиц
     */
    public function getAbout(int $id)
    {
        return Group::select('title', 'name')
            ->where('groups.id', $id)
            ->join('students', 'students.group_id', '=', 'groups.id')
            ->get();
    }
}