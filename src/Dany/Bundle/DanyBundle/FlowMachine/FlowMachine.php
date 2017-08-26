<?php

namespace Dany\Bundle\DanyBundle\FlowMachine;

use Dany\Library\Exception\InvalidFlowException;

class FlowMachine implements FlowMachineInterface
{
    /**
     * @var array $flows
     */
    private $flows;
    /**
     * FlowMachine constructor.
     * @param array $flows
     */
    public function __construct(array $flows)
    {
        $this->validateFlows($flows);

        $this->flows = $flows;
    }
    /**
     * @inheritdoc
     */
    public function runFlow() : void
    {

    }

    private function validateFlows(array $flows)
    {
        foreach ($flows as $flow) {
            if (!$flow instanceof FlowInterface) {
                throw new InvalidFlowException(
                    sprintf(
                        'Invalid flow service. Service \'%s\' has to implement %s interface',
                        get_class($flow),
                        FlowInterface::class
                    )
                );
            }
        }
    }
}