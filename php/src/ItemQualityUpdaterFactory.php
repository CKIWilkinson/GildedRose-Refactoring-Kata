<?php

namespace GildedRose;

use GildedRose\Items\ConjuredItemQualityUpdater;
use GildedRose\Items\ItemQualityUpdater;
use GildedRose\Items\AgingItemQualityUpdater;
use GildedRose\Items\BackstagePassItemQualityUpdater;
use GildedRose\Items\LegendaryItemQualityUpdater;
use GildedRose\Items\RegularItemQualityUpdater;

class ItemQualityUpdaterFactory
{
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const AGED_BRIE = 'Aged Brie';
    const CONJURED_MANA_CAKE = 'Conjured Mana Cake';
    const BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';

    const TYPE_MAP = [
        self::SULFURAS => LegendaryItemQualityUpdater::class,
        self::AGED_BRIE => AgingItemQualityUpdater::class,
        self::CONJURED_MANA_CAKE => ConjuredItemQualityUpdater::class,
        self::BACKSTAGE_PASS => BackstagePassItemQualityUpdater::class,
    ];
    public static function createItem(Item $item): ItemQualityUpdater
    {
        if (array_key_exists($item->name, self::TYPE_MAP)) {
            $class = self::TYPE_MAP[$item->name];
            return new $class($item);
        }

        return new RegularItemQualityUpdater($item);
    }
}