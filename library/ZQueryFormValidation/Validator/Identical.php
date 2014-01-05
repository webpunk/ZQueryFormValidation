<?php 
/**
 * Renders the necessary jquery.validate code for an Identical validator 
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Validator_Identical extends ZQueryFormValidation_Validator_Base {
    protected $_usesJQValidationMethods = array('equalTo', 'pattern');
    
    /**
     * renders approriate regex that corresponds to Identical (requires additional-methods.min.js)
     * @return string
     */
    public function render() {
		$token = $this->_validator->getToken();
		
		// check if token is a form element or a constant
		$isElem = null;
		foreach ($this->_form->getElements() as $elem) {
			if ($elem->getName() == $token) {
			    $isElem = $elem;
			    break;
			}
		}
		
		if ($isElem != null) {
		    $id = $isElem->getId();
		    if (!isset($id))
		        throw new Exception('ZQueryFormValidation_Validator_Identical requires an ID to be set for the attribute referenced.');
		    return 'equalTo: "#' . $isElem->getId() . '"';
		} else
		    return 'pattern:"' . $token . '",';
    }

    /**
     * (non-PHPdoc)
     * @see ZQueryFormValidation_Validator_Base::getRulesUsed()
     */
    public function getRulesUsed() {
    	$result = $this->render();
    	return array(substr($result, 0, strpos($result, ':')));
    }
}