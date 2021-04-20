<?php

namespace Chess\ML\Supervised\Regression\Sampler\Binary;

use Chess\Board;
use Chess\Event\Picture\Standard as StandardEventPicture;
use Chess\Heuristic\Picture\Standard as StandardHeuristicPicture;
use Chess\PGN\Symbol;

class Sampler
{
    private $board;

    private $sample;

    public function __construct(Board $board)
    {
        $this->board = $board;

        $this->sample = [
            Symbol::WHITE => [],
            Symbol::BLACK => [],
        ];
    }

    public function setBoard(Board $board)
    {
        $this->board = $board;

        return $this;
    }

    public function sample(): array
    {
        $eventPicture = (new StandardEventPicture($this->board->getMovetext()))->take();
        $heuristicPicture = (new StandardHeuristicPicture($this->board->getMovetext()))->take();

        $this->sample = [
            Symbol::WHITE => array_merge(
                end($eventPicture[Symbol::WHITE]),
                $this->round(end($heuristicPicture[Symbol::WHITE]))
            ),
            Symbol::BLACK => array_merge(
                end($eventPicture[Symbol::BLACK]),
                $this->round(end($heuristicPicture[Symbol::BLACK]))
            ),
        ];

        return $this->sample;
    }

    protected function round(array $arr): array
    {
        $items = [];
        foreach ($arr as $item) {
            $items[] = round($item, 0, PHP_ROUND_HALF_DOWN);
        }

        return $items;
    }
}
