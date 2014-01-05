<?php
/**
 * Abstract base class for all ZQueryFormValidation_Validator classes. 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
abstract class ZQueryFormValidation_Validator_Base {
    // instance of a Zend_Validate_Abstract class
	protected $_validator;	
	
	// instance of a Zend_Form class
	protected $_form; 		
	
	// an array defining which JQueryValidation rules may be used
	protected $_usesJQValidationMethods = array();
	
	/**
	 * Constructor - well, it's not that thrilling
	 * @param Zend_Validate_Abstract $validator
	 * @param Zend_Form $form the form the $validator belongs to
	 */
	public function __construct(Zend_Validate_Abstract $validator, Zend_Form $form = null) {
		$this->_validator = $validator;
		$this->_form = $form;
	}

	/**
	 * returns an array of rules which may be used by this validator 
	 * @return array
	 */
	public function getJQValidationMethods() {
		return $this->_usesJQValidationMethods;
	}
	
	/**
	 * if this validator results in a set of pattern rules, this method return the RegEx pattern used by the last pattern. Otherwise null will be returned.
	 * @return string / null 
	 */
	public function getPatternUsed() {
	    $rules = $this->getRulesUsed();
	    if (count($rules) == 1 && $rules[0] == 'pattern') {
	    	$rule = $this->render();
	    	return trim(substr($rule, strpos($rule, ':')+1), ', ');	
	    }
		return null;
	}
	
	/**
	 * To be implemented by all classes extending ZQueryFormValidation_Validator_Base.
	 * Render the js code used by jQueryValidation plugin
	 */
	public abstract function render();
	
	/**
	 * To be implemented by all classes extending ZQueryFormValidation_Validator_Base
	 * return rules actually used by jQueryValidation plugin
	 */
	public abstract function getRulesUsed();
}