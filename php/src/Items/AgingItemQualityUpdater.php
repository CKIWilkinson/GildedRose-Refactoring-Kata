<?php

namespace GildedRose\Items;

class AgingItemQualityUpdater extends ItemQualityUpdater
{
    function updateQuality(): void
    {
        $item = $this->item;

        $item->quality += 1;

        if ($item->sellIn <= 0) {
            $item->quality += 1;
        }

        $item->sellIn -= 1;

        $this->qualityRangeChecker();
    }

}