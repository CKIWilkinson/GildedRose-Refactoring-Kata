<?php

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\QualityUpdateInterface;

abstract class ItemQualityUpdater implements QualityUpdateInterface
{
    public function __construct(protected Item $item)
    {

    }

    public function updateQuality():void
    {
        $this->calculateQuality();
        $this->qualityRangeChecker();
    }

    protected function qualityRangeChecker()
    {
        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        } else if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}