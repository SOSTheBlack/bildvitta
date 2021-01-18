<?php

namespace App\Component\Grifo;

use Exception;
use SplDoublyLinkedList;
use SplQueue;

/**
 * Class GrifoComponent
 *
 * @package App\Component
 */
class GrifoComponent extends BaseGrifoComponent
{
    private array $visited;

    private array $path;

    private SplQueue $queue;

    /**
     * GrifoComponent constructor.
     *
     * @param $graph
     */
    public function __construct(array $graph = [])
    {
        $this->graph = $graph;
    }

    /**
     * @return array
     *
     * @throws Exception
     */
    public function getStepListToConversion(): array
    {
        $this->resetVisited();
        $this->visited[$this->origin] = true;

        $this->queue = new SplQueue;
        $this->queue->enqueue($this->origin);

        $this->path = [];
        $this->path[$this->origin] = new SplDoublyLinkedList;
        $this->path[$this->origin]->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP);
        $this->path[$this->origin]->push($this->origin);

        $this->searchDestination();

        if (! isset($this->path[$this->destiny])) {
            throw new Exception(400, 'Currency conversion is not possible');
        }

        return $this->definedSteps();
    }

    private function resetVisited()
    {
        $this->visited = [];
        foreach (array_keys($this->graph) as $coinCode) {
            $this->visited[$coinCode] = false;
        }
    }

    private function searchDestination()
    {
        while (! $this->queue->isEmpty() && $this->queue->bottom() != $this->destiny) {
            $node = $this->queue->dequeue();
            if (! empty($this->graph[$node])) {
                foreach ($this->graph[$node] as $currencyCode => $price) {
                    if (! $this->visited[$currencyCode]) {
                        $this->queue->enqueue($currencyCode);
                        $this->visited[$currencyCode] = true;

                        $this->path[$currencyCode] = clone $this->path[$node];
                        $this->path[$currencyCode]->push($currencyCode);
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    private function definedSteps(): array
    {
        $steps = [];

        foreach ($this->path[$this->destiny] as $index => $coinCode) {
            $hopTo = $index < $this->path[$this->destiny]->count() - 1 ? 1 : 0;

            if ($hopTo == 0) {
                break;
            }

            $steps[] = [
                'from' => $coinCode,
                'to'   => $this->path[$this->destiny][$index + $hopTo],
            ];
        }

        return $steps;
    }
}
