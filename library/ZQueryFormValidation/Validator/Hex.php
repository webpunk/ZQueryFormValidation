<?php 
/**
 * Renders the necessary jquery.validate code for a Hex validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Hex extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('pattern');
    
    /**
     * Uses a pattern to check if value is a valid hex value
     * @return string
     */
    public function render() {
        return 'pattern:"[A-Fa-f0-9]*",';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}