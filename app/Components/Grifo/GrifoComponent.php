<?php

namespace App\Components\Grifo;

use SplDoublyLinkedList;
use SplQueue;

/**
 * Class GrifoComponent.
 *
 * @link https://www.sitepoint.com/data-structures-4/
 *
 * @package App\Component
 */
class GrifoComponent extends BaseGrifoComponent implements Grifo
{
    use GrifoHelper;

    /**
     * Coin from.
     *
     * @var string
     */
    protected string $origin;

    /**
     * Coin to.
     *
     * @var string
     */
    protected string $destiny;

    /**
     * Data graph.
     *
     * @var array
     */
    protected array $graph;

    /**
     * @param  int  $quantity
     *
     * @return float
     *
     * @throws GrifoException
     */
    public function conversionPrice(int $quantity): float
    {
        $conversionSteps = $this->getStepListToConversion();
        $graph = $this->getGraph();

        foreach ($conversionSteps as $conversion) {
            $quantity = $quantity * $graph[$conversion['from']][$conversion['to']];
        }

        return $quantity;
    }

    /**
     * @return array
     *
     * @throws GrifoException
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
            throw new GrifoException(vsprintf('Currency(%s->%s) conversion is not possible', [$this->origin, $this->destiny]), 1001);
        }

        return $this->definedSteps();
    }

    /**
     * @param  string  $origin
     *
     * @return Grifo
     */
    public function setOrigin(string $origin): Grifo
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @param  string  $destiny
     *
     * @return Grifo
     */
    public function setDestiny(string $destiny): Grifo
    {
        $this->destiny = $destiny;

        return $this;
    }

    /**
     * @return array
     */
    public function getGraph(): array
    {
        return $this->graph;
    }
}
