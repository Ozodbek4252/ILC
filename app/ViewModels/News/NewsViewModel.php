<?php

declare(strict_types=1);

namespace App\ViewModels\News;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class NewsViewModel extends BaseViewModel
{
    public int $id;
    public string $image;
    public string $seo_keywords;
    public string $seo_description;
    public ?bool $is_published;

    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->image = $this->_data->image;
        $this->seo_keywords = $this->_data->seo_keywords;
        $this->seo_description = $this->_data->seo_description;
        $this->is_published = $this->_data->is_published;

        $this->translations = $this->getTranslations($this->_data->translations);
    }

    /**
     * Get translations from a collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    private function getTranslations(Collection $collection): array
    {
        // Group the collection by language code
        $groupedByLang = $collection->groupBy(function ($item) {
            return $item->lang->code;
        });

        // Map each group to group by column name and return only the first item
        $mapped = $groupedByLang->map(function ($group) {
            return $group->groupBy('column_name')->map->first();
        });

        // Convert the mapped collection to array
        return $mapped->toArray();
    }
}
