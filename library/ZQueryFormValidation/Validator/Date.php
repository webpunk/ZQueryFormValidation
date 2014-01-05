<?php 
/**
 * Renders the necessary jquery.validate code for a Date validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Date extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('dateISO');
    
    /**
     * Currently uses dateISO to check if a date is valid. Should be extend to support locals.
     * @return string
     */
    public function render() {
        return 'dateISO:true,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}