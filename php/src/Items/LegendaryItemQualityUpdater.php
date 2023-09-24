<?php

declare(strict_types=1);

namespace GildedRose\Items;

class LegendaryItemQualityUpdater extends ItemQualityUpdater
{
    public function calculateQuality(): void
    {
        // Legendary Items never change quality or need to be sold
    }

    public function qualityRangeChecker(): void
    {
        // Legendary Items can have qualities outside the normal range
    }
}
