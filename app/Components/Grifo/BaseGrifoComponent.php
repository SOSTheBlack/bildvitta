<?php

namespace App\Components\Grifo;

use SplQueue;

/**
 * Class BaseGrifoComponent
 *
 * @package App\Components\Grifo
 */
abstract class BaseGrifoComponent
{
    /**
     * Queue to keep a list of unvisited nodes so we can go back and process them after each level.
     *
     * @var array
     */
    protected array $visited;

    /**
     * Patch that will store the shortest path to reach the destination.
     *
     * @var array
     */
    protected array $path;

    /**
     *  The SplQueue class provides the main functionalities of a queue implemented using a doubly linked list.
     *
     * @var SplQueue
     */
    protected SplQueue $queue;

    /**
     * Clear queue visited.
     *
     * @return void
     */
    protected function resetVisited(): void
    {
        $this->visited = [];

        foreach (array_keys($this->graph) as $coinCode) {
            $this->visited[$coinCode] = false;
        }
    }

    /**
     * Push graph to patch.
     *
     * @return void
     */
    protected function searchDestination(): void
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
     * Conversion path.
     *
     * @return array
     */
    protected function definedSteps(): array
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
