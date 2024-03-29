<?php

namespace App\ViewModels;

interface ViewModelContract
{
    public function toView(string $viewName, array $additionalParams = []);
}
