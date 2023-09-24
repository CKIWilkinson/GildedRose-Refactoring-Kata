<?php

namespace GildedRose\Items;

class BackstagePassItemQualityUpdater extends ItemQualityUpdater
{
    function updateQuality(): void
    {
        $item = $this->item;
        $item->quality += 1;

        if ($item->sellIn <= 10) {
            $item->quality += 1;
        }

        if ($item->sellIn <= 5) {
            $item->quality += 1;
        }

        if ($item->sellIn <= 0) {
            $item->quality = 0;
        }

        $item->sellIn -= 1;

        $this->qualityRangeChecker();
    }
}