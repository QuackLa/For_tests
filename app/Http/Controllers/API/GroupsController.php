<?php

namespace App\Http\Controllers\API;

use App\Models\Group;
use App\Models\Plan;
use Illuminate\Http\Request;

use App\Http\Requests\Group\GroupAboutRequest;
use App\Http\Requests\Group\GroupCreateRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Http\Requests\Group\GroupDeleteRequest;
use App\Http\Requests\Group\PlanGetRequest;
use App\Http\Requests\Group\PlanCreateRequest;
use App\Http\Requests\Group\PlanChangeRequest;

class GroupsController extends CollegeController
{
    // Для модели групп
    private $modelGroup;
    // Для модели учебного плана групп
    private $modelPlan;

    /**
     * Конструктор класса
     */
    public function __construct(Group $group, Plan $plan)
    {
        $this->modelGroup = $group;
        $this->modelPlan = $plan;
    }

    /**
     * Весь список групп
     */
    public function list()
    {
        $list = $this->modelGroup->paginate(10);

        return response()->json([
            'data' => $list->all(),
        ]);
    }

    /**
     * Информация о конкретной группе
     */
    public function about(GroupAboutRequest $request)
    {
        $group = $this->modelGroup->getAbout($request->id);

        return response()->json([
            'data' => $group,
        ]);
    }

    /**
     * Создать группу
     */
    public function create(GroupCreateRequest $request)
    {
        $group = $this->modelGroup->create($request->all());
        
        return response()->json($group);
    }

    /**
     * Изменить группу
     */
    public function update(GroupUpdateRequest $request)
    {
        $group = $this->modelGroup->whereId($request->id)->update($request->title);

        return response()->json($group);
    }

    /**
     * Удалить группу
     */
    public function delete(GroupDeleteRequest $request)
    {
        $gruop = $this->modelGroup->whereId($request->id)->delete();

        return response()->json($gruop);
    }

    /**
     * Получить план лекций по конкретной группе
     */
    public function getPlan(PlanGetRequest $request)
    {
        $plan = $this->modelPlan->getAbout($request->id);

        return response()->json([
            'data' => $plan,
        ]);
    }

    /**
     * Создать план лекций для конкретной группе
     */
    public function createPlan(PlanCreateRequest $request)
    {
        $plan = $this->modelPlan->create($request->all());
        
        return response()->json($plan);
    }

    /**
     * Изменить план лекций для конкретной группе
     */
    public function changePlan(PlanChangeRequest $request)
    {
        $plan = $this->modelPlan->changePlan($request);

        return response()->json($plan);
    }
}