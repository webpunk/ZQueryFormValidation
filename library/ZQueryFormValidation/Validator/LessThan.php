<?php 
/**
 * Renders the necessary jquery.validate code for a LessThan validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_LessThan extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('max');
    
    /**
     * uses max: to render a corresponding jquery.validate test
     * @return string
     */
    public function render() {
        return 'max:' . $this->_validator->getMax() . ',';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}