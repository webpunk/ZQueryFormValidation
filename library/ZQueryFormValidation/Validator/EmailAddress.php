<?php 
/**
 * Renders the necessary jquery.validate code for an EmailAddress validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_EmailAddress extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('email');
    
    /**
     * simply renders email true
     * @return string
     */
    public function render() {
        return 'email:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}