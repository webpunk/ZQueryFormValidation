<?php 
/**
 * Renders the necessary jquery.validate code for an Iban validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Iban extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('iban');
    
    /**
     * simply renders iban true (requires additional-methods.min.js)
     * @return string
     */
    public function render() {
        return 'iban:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}