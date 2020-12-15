<?php
namespace App;

class Caixa
{
    /**
     * @var array
     */
    protected $items = [];
    /**
     * Constrói a caixa com os items recebidos
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }
    public function searchInArray($item)
    {
        return in_array($item, $this->items);
    }
    public function getItem()
    {
        return array_shift($this->items);
    }
    public function firstLetter($letter)
    {
        return array_filter($this->items, function ($item) use ($letter) {
            return stripos($item, $letter) === 0;
        });
    }
}
