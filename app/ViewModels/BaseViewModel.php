<?php

namespace App\ViewModels;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

abstract class BaseViewModel implements ViewModelContract
{
    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
        $this->populate();
    }

    abstract protected function populate();


    public function toView(string $viewName, array $additionalParams = []): Factory|View|Application
    {
        return view($viewName, array_merge(['item' => $this], $additionalParams));
    }

    /**
     * @param      $array
     * @param      $locale
     * @param bool $json
     * @return string
     */
    public function trans($array, $locale = null, bool $json = false): string
    {
        if ($json === true) {
            try {
                $array = (array)json_decode($array, false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                return '';
            }
        }

        if (!$locale) {
            $locale = app()->getLocale();
        }

        return $array[$locale] ?? '';
    }
}
