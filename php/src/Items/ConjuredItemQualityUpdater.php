<?php

namespace GildedRose\Items;

use GildedRose\Items\ItemQualityUpdater;

class ConjuredItemQualityUpdater extends ItemQualityUpdater
{

    function updateQuality()
    {
        $item = $this->item;
        $item->quality -= 2;

        if ($item->sellIn <= 0) {
            $item->quality -= 4;
        }

        $item->sellIn -= 1;

        $this->qualityRangeChecker();
    }
}