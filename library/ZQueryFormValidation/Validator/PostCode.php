<?php 
/**
 * Renders the necessary jquery.validate code for a PostCode validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_PostCode extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('pattern');
    
    /**
     * Translates the format used by the PostCode validator to a pattern. (requires additional-methods.min.js) 
     * @todo currently, transformation is done by copy&paste, i.e. there is no real translation between a PHP and a JS regex. Has to be improved.
     * @return string
     */
    public function render() {
        $format = $this->_validator->getFormat();
        return 'pattern:' . $format . ',';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}