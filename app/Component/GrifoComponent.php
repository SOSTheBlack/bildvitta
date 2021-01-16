<?php

namespace App\Component;

use Exception;
use SplDoublyLinkedList;
use SplQueue;

/**
 * Class GrifoComponent
 *
 * @package App\Component
 */
class GrifoComponent
{
    /**
     * @var array
     */
    protected array $graph;

    protected array $visited;

    protected array $path;

    protected SplQueue $queue;

    /**
     * GrifoComponent constructor.
     *
     * @param $graph
     */
    public function __construct($graph)
    {
        $this->graph = $graph;
    }

    /**
     * @param $origin
     * @param $destination
     *
     * @return array
     *
     * @throws Exception
     */
    public function firstSearch($origin, $destination): array
    {
        $this->resetVisited();
        $this->visited[$origin] = true;

        $this->queue = new SplQueue;
        $this->queue->enqueue($origin);

        $this->path = [];
        $this->path[$origin] = new SplDoublyLinkedList;
        $this->path[$origin]->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP);
        $this->path[$origin]->push($origin);

        $this->searchDestination($destination);

        if (! isset($this->path[$destination])) {
            throw new Exception(400, 'Currency conversion is not possible');
        }

        return $this->definedSteps($destination);
    }

    private function resetVisited()
    {
        foreach (array_keys($this->graph) as $coinCode) {
            $this->visited[$coinCode] = false;
        }
    }

    /**
     * @param $destination
     */
    private function searchDestination($destination)
    {
        while (! $this->queue->isEmpty() && $this->queue->bottom() != $destination) {
            $node = $this->queue->dequeue();

            if (! empty($this->graph[$node])) {
                foreach ($this->graph[$node] as $coinCode => $price) {
                    if (! $this->visited[$coinCode]) {
                        $this->queue->enqueue($coinCode);
                        $this->visited[$coinCode] = true;

                        $this->path[$coinCode] = clone $this->path[$node];
                        $this->path[$coinCode]->push($coinCode);
                    }
                }
            }
        }
    }

    /**
     * @param $destination
     *
     * @return array
     */
    private function definedSteps($destination): array
    {
        $steps = [];

        foreach ($this->path[$destination] as $index => $coinCode) {
            $hopTo = $index < $this->path[$destination]->count() - 1 ? 1 : 0;

            if ($hopTo == 0) {
                break;
            }

            $steps[] = [
                'from' => $coinCode,
                'to'   => $this->path[$destination][$index + $hopTo],
            ];
        }

        return $steps;
    }
}
