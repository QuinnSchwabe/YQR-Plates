<?php

namespace App\Factories;

use App\Models\Promotion;
use App\Factories\PromotionDisplay;

class PromotionDisplayFactory {
    protected $promotions;

    public function __construct($promotions)
    {
        $this->promotions = $promotions;
    }

    public function renderPromotionDisplay($type): PromotionDisplay  {
        if($type == 'limited time'){
            return new LimitedTimePromotionDisplay($this->promotions->where('promotion_type', 'limited time'));
        }
        elseif ($type == 'daily deal'){
            return new DailyDealPromotionDisplay($this->promotions->where('promotion_type', 'daily deal'));
        }
        elseif ($type == 'happy hour'){
            return new HappyHourPromotionDisplay($this->promotions->where('promotion_type', 'happy hour'));
        }
        else{
            throw new \Exception("Invalid promotion type.");
        }
    }
}