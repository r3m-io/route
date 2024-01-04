<?php
namespace Package\R3m\Io\Route\Trait;

use R3m\Io\Config;

use R3m\Io\Module\Core;
use R3m\Io\Module\Dir;
use R3m\Io\Module\File;

use R3m\Io\Exception\ObjectException;
use R3m\Io\Module\Route;

trait Main {

    /**
     * @throws ObjectException
     */
    public function list($options=[]): void
    {
        Core::interactive();
        $options = Core::object($options, Core::OBJECT_OBJECT);
        $object = $this->object();

        $route = $object->route();
        if(!$route){
            return;
        }
        $list = $route->data();
        if(empty($list)){
            return;
        }
        foreach($list as $key => $record){
            if(property_exists($record, 'priority')){
                echo $key . ' ('. $record->priority .')' . PHP_EOL;
                if(property_exists($record, 'controller')){
                    echo '  Controller: ' . $record->controller . PHP_EOL;
                }
                if(property_exists($record, 'path')){
                    echo '  Path: ' . $record->path . PHP_EOL;
                }
                if(property_exists($record, 'redirect')){
                    echo '  Redirect: ' . $record->redirect . PHP_EOL;
                }
                if(property_exists($record, 'url')){
                    echo '  Url: ' . $record->url . PHP_EOL;
                }
                if(property_exists($record, 'method')){
                    echo '  Method: ' .  implode(', ', $record->method) . PHP_EOL;
                }
            }
        }
    }

    /**
     * @throws ObjectException
     */
    public function restart($options=[]): void
    {
        $options = Core::object($options, Core::OBJECT_OBJECT);
        $object = $this->object();
        $object->config('ramdisk.is.disabled', true);
        $posix_id = $object->config(Config::POSIX_ID);
        $temp_dir = $object->config('framework.dir.temp');
        $dir = new Dir();
        $read = $dir->read($temp_dir, true);
        if($read){
            foreach($read as $file){
                if($file->type === Dir::TYPE){
                    if($posix_id > 0){
                        if(
                            stristr($file->url, strtolower(Route::NAME)) !== false &&
                            stristr($file->url, $posix_id) !== false &&
                            File::exist($file->url)
                        ){
                            Dir::remove($file->url);
                            echo 'Removed: ' . $file->url . PHP_EOL;
                        }
                    } else {
                        if(
                            stristr($file->url, strtolower(Route::NAME)) !== false &&
                            file_exists($file->url)
                        ){
                            Dir::remove($file->url);
                            echo 'Removed: ' . $file->url . PHP_EOL;
                        }
                    }
                }
            }
        }
    }
}