<?php

declare(strict_types=1);

namespace App\ViewModels\About;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class AboutViewModel extends BaseViewModel
{
    public int $id;
    public string $background_image;
    public string $background_image_url;
    public string $sec1_image;
    public string $sec1_image_url;
    public string $sec2_image;
    public string $sec2_image_url;
    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->background_image = $this->_data->background_image;
        $this->background_image_url = $this->_data->background_image_url;
        $this->sec1_image = $this->_data->sec1_image;
        $this->sec1_image_url = $this->_data->sec1_image_url;
        $this->sec2_image = $this->_data->sec2_image;
        $this->sec2_image_url = $this->_data->sec2_image_url;
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
