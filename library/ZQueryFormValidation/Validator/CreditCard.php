<?php 
/**
 * Renders the necessary jquery.validate code for a CreditCard validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_CreditCard extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('creditcard');
    
    /**
     * simply renders creditcard: true
     * @return string
     */
    public function render() {
        return 'creditcard:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}