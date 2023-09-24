<?php

namespace GildedRose\Items;

class LegendaryItemQualityUpdater extends ItemQualityUpdater
{
    function calculateQuality(): void
    {
        // Legendary Items never change quality or need to be sold
    }

    function qualityRangeChecker(): void
    {
        // Legendary Items can have qualities outside the normal range
    }
}