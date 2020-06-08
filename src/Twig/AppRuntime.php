<?php

namespace App\Twig;

use App\Service\DeviseService;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    public $currencyService;
    public function __construct(DeviseService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function currencyConvert($number)
    {
        dump($this->currencyService->usagerDevise);
        return $this->currencyService->getUsagerDevise($number);
    }
}