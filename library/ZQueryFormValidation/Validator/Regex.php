<?php 
/**
 * Renders the necessary jquery.validate code for a Regex validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Regex extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('pattern');
    
    /**
     * "Translates" the php regex to a pattern (requires additional-methods.min.js)
     * @todo currently, transformation is done by copy&paste, i.e. there is no real translation between a PHP and a JS regex. Has to be improved in order to support for instance lookbehind assertions or recursion.
     * @return string
     */
    public function render() {
        $pattern = $this->_validator->getPattern();
        return 'pattern:' . $pattern . ',';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}