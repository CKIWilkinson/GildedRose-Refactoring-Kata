<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\QualityUpdateInterface;

abstract class ItemQualityUpdater implements QualityUpdateInterface
{
    public function __construct(
        protected Item $item
    ) {
    }

    public function updateQuality(): void
    {
        $this->calculateQuality();
        $this->qualityRangeChecker();
    }

    protected function qualityRangeChecker(): void
    {
        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        } elseif ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}
