<?php
namespace PMA\DI;

require_once 'libraries/di/ReflectorItem.class.php';

class ServiceItem extends ReflectorItem
{

    /** @var mixed */
    protected $instance;

    /**
     * Constructor
     *
     * @param Container $container
     * @param mixed $definition
     */
    function __construct(Container $container, $definition)
    {
        parent::__construct($container, $definition);
    }

    /**
     * Get the instance of the service
     *
     * @param array $params
     * @return mixed
     */
    public function get($params = array())
    {
        if (!isset($this->instance)) {
            $this->instance = $this->invoke();
        }
        return $this->instance;
    }
}