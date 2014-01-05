<?php 
/**
 * Renders the necessary jquery.validate code for a Hostname validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Hostname extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('url');
    
    /**
     * currently this simply renders "url:true", thus not taking into account the different options Zend_Validate_Hostname supports. 
     * @todo has to be improved
     * @return string
     */
    public function render() {
        return 'url: true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}