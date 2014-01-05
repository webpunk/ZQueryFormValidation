<?php 
/**
 * Renders the necessary jquery.validate code for a Between validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Between extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('range');
    
    /**
     * renders min and max length
     * @return string
     */
    public function render() {
        return 'range:[' . $this->_validator->getMin() . ',' . $this->_validator->getMax() . '],';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}