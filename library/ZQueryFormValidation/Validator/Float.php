<?php 
/**
 * Renders the necessary jquery.validate code for a Float validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Float extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('number');
    
    /**
     * simply renders number true
     * @return string
     */
    public function render() {
        return 'number:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}