<?php

declare(strict_types=1);

namespace GildedRose\Items;

class AgingItemQualityUpdater extends ItemQualityUpdater
{
    public function calculateQuality(): void
    {
        $item = $this->item;

        ++$item->quality;

        if ($item->sellIn <= 0) {
            ++$item->quality;
        }

        --$item->sellIn;
    }
}
