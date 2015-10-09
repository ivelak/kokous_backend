<?php

namespace App\Services;

Class POFBackend
{
    protected $url;


    public function __construct($url = null) {
        $this->url = isset($url) ? $url : 'http://pof-backend.partio.fi/';
    }
    
    /**
     * It's a debug method!
     */
    public function doSomething(){
        dd('Hellooo!');
    }
    
    /**
     * Returns JSON for item in POF
     * @param String $guid
     * @return String
     */
    public function getItemJSON($guid){
        return file_get_contents($this->url . 'item-json/?postGUID=' . $guid);
    }
    
    /**
     * Returns Array for item in POF
     * @param String $guid
     * @return Array
     */
    public function getItem($guid){
        return json_decode($this->getItemJSON($guid), true);
    }
    
    /**
     * Returns Array for the program tree in POF
     * @return Array 
     */
    public function getFullTree(){
        return json_decode($this->getFullTreeJSON(), true);
    }
    
    /**
     * Returns JSON for the program tree in POF
     * @return String  
     */
    public function getFullTreeJSON(){
        return file_get_contents($this->url . 'spn-ohjelma-json-taysi/?postGUID=86b5b30817ce3649e590c5059ec88921');
    }
}

