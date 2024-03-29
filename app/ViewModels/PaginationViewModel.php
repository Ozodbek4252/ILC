<?php

namespace App\ViewModels;

use App\DataObjects\DataObjectCollection;
use App\Presenters\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PaginationViewModel implements ViewModelContract
{
    protected DataObjectCollection $dataCollection;
    protected string $viewModel;

    public LengthAwarePaginator $pagination;

    /**
     * @param DataObjectCollection $dataCollection
     * @param string $viewModel
     */
    public function __construct(DataObjectCollection $dataCollection, string $viewModel)
    {
        $this->dataCollection = $dataCollection;
        $this->viewModel = $viewModel;

        $this->dataCollection->items->transform(function ($value) use ($viewModel) {
            return new $viewModel($value);
        });

        $parameters = request()->getQueryString();
        $parameters = preg_replace('/&page(=[^&]*)?|^page(=[^&]*)?&?/', '', $parameters);
        $path = url(request()->path()) . (empty($parameters) ? '' : '?' . $parameters);

        $this->pagination = new LengthAwarePaginator($this->dataCollection->items, $this->dataCollection->totalCount, $this->dataCollection->limit, $this->dataCollection->page);
        $this->pagination->withPath($path);
    }

    public function toView(string $viewName, array $additionalParams = []): Factory|View|Application
    {
        return view($viewName, array_merge(['pagination' => $this->pagination, 'data' => $additionalParams]));
    }

    public function toJsonApi($toSnakeCase = true): ApiResponse
    {
        if ($toSnakeCase) {
            $data = [
                'items' => $this->toSnakeCase($this->dataCollection->items),
                'page' => $this->dataCollection->page,
                'limit' => $this->dataCollection->limit,
                'total_count' => $this->dataCollection->totalCount,
            ];
            return ApiResponse::getSuccessResponse($data);
        }
        return ApiResponse::getSuccessResponse($this->dataCollection);
    }

    protected function toSnakeCase(iterable $items): array
    {
        $res = [];
        try {
            foreach ($items as $item) {
                $row = [];
                if (is_scalar($item)) {
                    $row = $item;
                } else if (is_array($item)) {
                    foreach ($item as $itemKey => $itemVal) {
                        $row[Str::snake($itemKey)] = is_iterable($itemVal) ? $this->toSnakeCase($itemVal) : $itemVal;
                    }
                } else {
                    $class = new \ReflectionClass($item);
                    $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);
                    foreach ($properties as $reflectionProperty) {
                        if ($reflectionProperty->isStatic()) {
                            continue;
                        }
                        $value = $reflectionProperty->getValue($item);
                        $row[Str::snake($reflectionProperty->getName())] = is_iterable($value) ? $this->toSnakeCase($value) : $value;
                    }
                }
                $res[] = $row;
            }
        } catch (\Exception $exception) {
        }
        return $res;
    }
}
