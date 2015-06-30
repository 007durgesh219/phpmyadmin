<?php
namespace PMA\DI;

require_once 'libraries/di/Item.int.php';
require_once 'libraries/di/AliasItem.class.php';
require_once 'libraries/di/ValueItem.class.php';
require_once 'libraries/di/ServiceItem.class.php';
require_once 'libraries/di/FactoryItem.class.php';

class Container
{

    /**
     * @var Item[] $content
     */
    protected $content = array();

    /**
     * @var Container
     */
    protected static $defaultContainer;

    /**
     * Create a dependency injection container
     *
     * @param Container $base
     */
    function __construct(Container $base = null)
    {
        if (isset($base)) {
            $this->content = $base->content;
        } else {
            $this->alias('container', 'Container');
        }
        $this->set('Container', $this);
    }

    /**
     * Get an object with given name and parameters
     *
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function get($name, $params = array())
    {
        if (isset($this->content[$name])) {
            return $this->content[$name]->get($params);
        }
        return null;
    }

    /**
     * Remove an object from container
     *
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->content[$name]);
    }

    /**
     * Rename an object in container
     *
     * @param string $name
     * @param string $newName
     */
    public function rename($name, $newName)
    {
        $this->content[$newName] = $this->content[$name];
        $this->remove($name);
    }

    /**
     * Set values in the container
     *
     * @param string|array $name
     * @param mixed $value
     */
    public function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $val) {
                $this->set($key, $val);
            }
            return;
        }
        $this->content[$name] = new ValueItem($value);
    }

    /**
     * Register a service in the container
     *
     * @param string $name
     * @param mixed $service
     */
    public function service($name, $service = null)
    {
        if (!isset($service)) {
            $service = $name;
        }
        $this->content[$name] = new ServiceItem($this, $service);
    }

    /**
     * Register a factory in the container
     *
     * @param string $name
     * @param mixed $factory
     */
    public function factory($name, $factory = null)
    {
        if (!isset($factory)) {
            $factory = $name;
        }
        $this->content[$name] = new FactoryItem($this, $factory);
    }

    /**
     * Register an alias in the container
     *
     * @param string $name
     * @param string $target
     */
    public function alias($name, $target)
    {
        // The target may be not defined yet
        $this->content[$name] = new AliasItem($this, $target);
    }

    /**
     * Get the global default container
     */
    public static function getDefaultContainer()
    {
        if (!isset(static::$defaultContainer)) {
            static::$defaultContainer = new Container();
        }
        return static::$defaultContainer;
    }
}