<?php

namespace Training\TestOM\Model;

use Training\TestOM\Model\ManagerInterface;

class Test
{

    private $manager;

    private $arrayList;

    private $name;

    private $number;

    private $managerFactory;

    /**
     * Test constructor.
     * @param \Training\TestOM\Model\ManagerInterface $manager
     * @param ManagerInterfaceFactory $managerFactory
     * @param $name
     * @param int $number
     * @param array $arrayList
     */
    public function __construct(
        ManagerInterface $manager,
        \Training\TestOM\Model\ManagerInterfaceFactory $managerFactory,
        $name,
        int $number,
        $arrayList = []
    ) {
        $this->manager        = $manager;
        $this->name           = $name;
        $this->number         = $number;
        $this->arrayList      = $arrayList;
        $this->managerFactory = $managerFactory;
    }

    public function log()
    {
        echo '<br>';
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        print_r($this->arrayList);
        echo '<br>';
        $newManager = $this->managerFactory->create();
        print_r(get_class($newManager));
        echo '<br>';
    }
}
