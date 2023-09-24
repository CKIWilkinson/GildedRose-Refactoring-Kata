<?php

namespace GildedRose\Items;

use GildedRose\Item;
use GildedRose\QualityUpdateInterface;

abstract class AbstractItem implements QualityUpdateInterface, \Stringable
{
    private string $name;
    private int $sellIn;
    private int $quality;

    public function __construct(Item $item)
    {
        $this->name = $item->name;
        $this->sellIn = $item->sellIn;
        $this->quality = $item->quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}