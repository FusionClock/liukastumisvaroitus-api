<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

abstract class ApiController extends Controller
{
    /**
     * @param ApiRequest $request
     *
     * @return JsonResponse
     */
    public function index(ApiRequest $request): JsonResponse
    {
        return JsonResponse::create($this->applyRequest($request)->get());
    }

    /**
     * @param ApiRequest $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(ApiRequest $request, int $id): JsonResponse
    {
        return JsonResponse::create($this->applyRequest($request)->find($id));
    }

    /**
     * @param ApiRequest $request
     *
     * @return Builder
     */
    private function applyRequest(ApiRequest $request): Builder
    {
        return tap($this->builder(), function (Builder $builder) use ($request) {
            $with = $request->expand()->toArray();

            $builder->with($with);

            $request->filter()->each(function (Collection $filter) use ($builder) {
                $builder->where($filter->first(), '=', $filter->last());
            });
        });
    }

    /**
     * @return Builder
     */
    abstract public function builder(): Builder;
}
