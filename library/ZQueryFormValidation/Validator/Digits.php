<?php 
/**
 * Renders the necessary jquery.validate code for a Digits validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Digits extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('digits');
    
    /**
     * simply renders digits true
     * @return string
     */
    public function render() {
        return 'digits:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}