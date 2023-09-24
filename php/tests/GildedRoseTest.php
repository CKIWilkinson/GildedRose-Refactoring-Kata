<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemQualityUpdaterFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testQualityReduces(): void
    {
        $items = [new Item('item', 2, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(1, $item->sellIn);
        $this->assertSame(1, $item->quality);
    }

    public function testMultipleItems(): void
    {
        $items = [
            new Item('item', 2, 2),
            new Item('other item', 4, 5),
        ];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame('item', $items[0]->name);
        $this->assertSame(1, $items[0]->sellIn);
        $this->assertSame(1, $items[0]->quality);

        $this->assertSame('other item', $items[1]->name);
        $this->assertSame(3, $items[1]->sellIn);
        $this->assertSame(4, $items[1]->quality);
    }

    public function testQualityImproves(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::AGED_BRIE, 2, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(3, $item->quality);
    }

    public function testLegendaryItem(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::SULFURAS, 2, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(2, $item->quality);
    }

    public function testQualityDoesNotExceed50(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::AGED_BRIE, 2, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(50, $item->quality);
    }

    public function testBackstageSellInAbove10(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::BACKSTAGE_PASS, 11, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(26, $item->quality);
    }

    public function testBackstageSellInBelow10(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::BACKSTAGE_PASS, 10, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(27, $item->quality);
    }

    public function testBackstageSellInBelow5(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::BACKSTAGE_PASS, 5, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(28, $item->quality);
    }

    public function testBackstageSellInBelow1(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::BACKSTAGE_PASS, 0, 25)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(0, $item->quality);
    }

    public function testQualityCannotBeBelow0(): void
    {
        $items = [new Item('item', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(0, $item->quality);
    }

    public function testQualityWhenSellinBelow0(): void
    {
        $items = [new Item('item', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(8, $item->quality);
    }

    public function testBrieWhenSellinBelow0(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::AGED_BRIE, 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(12, $item->quality);
    }

    public function testConjuredItemDegradation(): void
    {
        $items = [new Item(ItemQualityUpdaterFactory::CONJURED_MANA_CAKE, 2, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $item = $items[0];
        $this->assertSame(1, $item->sellIn);
        $this->assertSame(48, $item->quality);
    }
}
