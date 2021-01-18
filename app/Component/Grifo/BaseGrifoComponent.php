<?php

namespace App\Component\Grifo;

/**
 * Class BaseGrifoComponent
 *
 * @package App\Component\Grifo
 */
abstract class BaseGrifoComponent
{
    use GrifoHelper;

    protected string $origin;

    protected string $destiny;

    protected array $graph;

    protected int $quantity;

    /**
     * @param  string  $origin
     *
     * @return BaseGrifoComponent
     */
    public function setOrigin(string $origin): BaseGrifoComponent
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @param  string  $destiny
     *
     * @return BaseGrifoComponent
     */
    public function setDestiny(string $destiny): BaseGrifoComponent
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

    /**
     *
     * @param  array  $graph
     *
     * @return BaseGrifoComponent
     */
    public function setGraph(array $graph): BaseGrifoComponent
    {
        $this->graph = $graph;

        return $this;
    }

    /**
     * @param  int  $quantity
     *
     * @return BaseGrifoComponent
     */
    public function setQuantity(int $quantity): BaseGrifoComponent
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return float
     */
    public function get(): float
    {
        $conversionSteps = $this->getStepListToConversion();
        $graph = $this->getGraph();
        $amount = $this->quantity;

        foreach ($conversionSteps as $conversion) {
            $amount = $amount * $graph[$conversion['from']][$conversion['to']];
        }

        return $amount;
    }
}
