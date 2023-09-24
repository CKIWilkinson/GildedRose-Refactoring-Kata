<?php

declare(strict_types=1);

namespace GildedRose\Items;

class ConjuredItemQualityUpdater extends ItemQualityUpdater
{
    public function calculateQuality()
    {
        $item = $this->item;
        $item->quality -= 2;

        if ($item->sellIn <= 0) {
            $item->quality -= 4;
        }

        --$item->sellIn;
    }
}
