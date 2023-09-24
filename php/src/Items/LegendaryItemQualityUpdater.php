<?php

namespace GildedRose\Items;

class LegendaryItemQualityUpdater extends ItemQualityUpdater
{
    function updateQuality(): void
    {
        // Legendary Items never change quality or need to be sold
    }
}