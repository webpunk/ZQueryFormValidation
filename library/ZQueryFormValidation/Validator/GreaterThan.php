<?php 
/**
 * Renders the necessary jquery.validate code for a GreaterThan validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_GreaterThan extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('min');
    
    /**
     * uses min: to render a corresponding jquery.validate test
     * @return string
     */
    public function render() {
        return 'min:' . $this->_validator->getMin() . ',';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}