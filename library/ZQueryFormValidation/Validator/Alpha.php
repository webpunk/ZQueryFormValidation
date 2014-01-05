<?php 
/**
 * Renders the necessary jquery.validate code for an Alpha validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Alpha extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('pattern');
    
    /**
     * renders approriate regex that corresponds to Alpha (requires additional-methods.min.js)
     * @return string
     */
    public function render() {
        if ($this->_validator->allowWhiteSpace)
            return 'pattern:"[\\\\w\\\\s]*",';
        else
			return 'pattern:"\\\\w*",';
    }
    
    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}