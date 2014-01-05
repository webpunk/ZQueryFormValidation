<?php 
/**
 * Renders the necessary jquery.validate code for a StringLength validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_StringLength extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('minlength');
    
    /**
     * renders min and max length
     * @return string
     */
    public function render() {
        return 'minlength:' . $this->_validator->getMin() . ',maxlength:' . $this->_validator->getMax() . ',';
    }
    
    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}