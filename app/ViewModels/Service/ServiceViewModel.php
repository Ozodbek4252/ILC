<?php

declare(strict_types=1);

namespace App\ViewModels\Service;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class ServiceViewModel extends BaseViewModel
{
    public int $id;
    public int $icon_id;
    public string $icon;
    public string $link;
    public string $image;
    public string $image_url;
    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->icon_id = $this->_data->icon_id;
        $this->icon = $this->_data->icon_path;
        $this->link = $this->_data->link;
        $this->image = $this->_data->image;
        $this->image_url = $this->_data->image_url;
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
