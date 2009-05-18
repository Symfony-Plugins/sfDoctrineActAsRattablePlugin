<?php
 
class Rattable extends Doctrine_Template
{
    /**
     * __construct
     *
     * @param string $array 
     * @return void
     */
    public function __construct(array $options = array())
    {
	    parent::__construct($options);
        $this->_plugin = new Doctrine_Rattable($this->_options);
    }

    /**
     * Initialize the Rattable plugin for the template
     *
     * @return void
     */
    public function setUp()
    {
        $this->_plugin->initialize($this->_table); 
    }

    /**
     * Get the plugin instance for the Rattable template
     *
     * @return void
     */
    public function getRattable()
    {
        return $this->_plugin;
    }
}