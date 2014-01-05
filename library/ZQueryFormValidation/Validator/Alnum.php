<?php 
/**
 * Renders the necessary jquery.validate code for an Alnum validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Alnum extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('pattern');
    
    /**
     * renders approriate regex that corresponds to Alnum (requires additional-methods.min.js)
     * @return string
     */
    public function render() {
       	$this->_locale = new Zend_Locale('auto');
       	
       	$additionalChars = '';
       	if ($this->_locale->getLanguage() == 'de') $additionalChars = '\xC4\xD6\xDC\xE4\xF6\xFC\xDF';	// see for instance http://www.utf8-chartable.de/

       	$whitespace = ($this->_validator->allowWhiteSpace ? '\s' : ''); 
       	
        return 'pattern:/^[\d\w' . $whitespace . $additionalChars . ']*$/,';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	return $this->_usesJQValidationMethods;
    }
}