<?php
namespace Package\R3m\Io\Route\Trait;

use R3m\Io\App;

use R3m\Io\Module\Core;
use R3m\Io\Module\File;

use R3m\Io\Node\Model\Node;

use Exception;
trait Main {

    /**
     * @throws Exception
     */
    public function list($options=[]): void
    {
        Core::interactive();
        $options = Core::object($options, Core::OBJECT_OBJECT);
        $object = $this->object();

        $route = $object->route();

        foreach($route as $key => $record){
            if(property_exists($record, 'priority')){
                echo $key . '('. $record->priority .')' . PHP_EOL;
                if(property_exists($record, 'controller')){
                    echo '  Controller: ' . $record->controller . PHP_EOL;
                }
                if(property_exists($record, 'path')){
                    echo '  Path: ' . $record->path . PHP_EOL;
                }
                if(property_exists($record, 'method')){
                    echo '  Method: ' .  implode(', ', $record->method) . PHP_EOL;
                }
            }
        }
    }
}