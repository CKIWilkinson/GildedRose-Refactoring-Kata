<?php

declare(strict_types=1);

namespace GildedRose\Items;

class BackstagePassItemQualityUpdater extends ItemQualityUpdater
{
    public function calculateQuality(): void
    {
        $item = $this->item;
        ++$item->quality;

        if ($item->sellIn <= 10) {
            ++$item->quality;
        }

        if ($item->sellIn <= 5) {
            ++$item->quality;
        }

        if ($item->sellIn <= 0) {
            $item->quality = 0;
        }

        --$item->sellIn;
    }
}
