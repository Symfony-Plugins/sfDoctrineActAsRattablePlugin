<?php

/**
 * Rattable
 *
 */
class Doctrine_Rattable extends Doctrine_Record_Generator
{
    protected $_options = array(
                            'className'     => '%CLASS%Rate',
                            'fields'        => array(),
                            'generateFiles' => false,
                            'table'         => false,
                            'pluginTable'   => false,
                            'children'      => array(),
                            'options'       => array(),
                            'criterias'     => 'rate',
                            'max_rate'      => 5,
                            'with_comment'  => true,
    );

    /**
     * __construct
     *
     * @param string $options
     * @return void
     */
    public function __construct($options)
    {
        $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
    }

    public function buildRelation()
    {
        $this->buildForeignRelation('Rate');
        $this->buildLocalRelation();
    }

    /**
     * buildDefinition
     *
     * @param object $Doctrine_Table
     * @return void
     */
    public function setTableDefinition()
    {
        $options = array('className' => $this->_options['className']);

        if(is_int($this->_options['rounding_rate']))
        {
            $type = 'integer';
            $length = 4;
        }
        else
        {
            $type = 'float';
            $length = null;
        }

        $options['range'] = array(0 => $this->_options['max_rate']);

        foreach ($this->_options['criterias'] as $fieldName)
        {
            $this->hasColumn($fieldName, $type, $length, $options);
        }


        $options = $this->_options['options'];

        if($this->_options['with_comment'])
        {
            $this->hasColumn('comment', 'string', 4000, $options);
        }


//        // Rewrite any relations to our original table
//        $originalName = $this->_options['table']->getClassnameToReturn();
//        $relations = $this->_options['table']->getRelationParser()->getPendingRelations();
//        foreach($relations as $table => $relation) {
//            if ($table != $this->_table->getTableName() ) {
//                // check that the localColumn is part of the moved col
//                if (isset($relation['local']) && in_array($relation['local'], $this->_options['fields'])) {
//                    // found one, let's rewrite it
//                    $this->_options['table']->getRelationParser()->unsetPendingRelations($table);
//
//                    // and bind the rewritten one
//                    $this->_table->getRelationParser()->bind($table, $relation);
//
//                    // now try to get the reverse relation, to rewrite it
//                    $rp = Doctrine::getTable($table)->getRelationParser();
//                    $others = $rp->getPendingRelation($originalName);
//                    if (isset($others)) {
//                        $others['class'] = $this->_table->getClassnameToReturn();
//                        $others['alias'] = $this->_table->getClassnameToReturn();
//                        $rp->unsetPendingRelations($originalName);
//                        $rp->bind($this->_table->getClassnameToReturn() ,$others);
//                    }
//                }
//            }
//        }
    }
}