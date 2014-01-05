<?php
/**
 * Represents a form element. Extends Zend_Form_Element with additional methods to render rules and messages used by jQueryValidation plugin.
 * @author Christian Koncilia
 * @package ZQueryFormValidation
 */
class ZQueryFormValidation_Form_Element extends Zend_Form_Element
{
    private $_form;
    private $_zqmessages;
    private $_zqvalidators;
    private $_jqvFunctionsCreated;	// new jQueryValidate functions introduced for this element

    /**
     * Construct an instance of ZQueryFormValidation_Form_Element from a given Zend_Form_Element
     * @param Zend_Form_Element $elem
     * @param Zend_Form $form
     * @param unknown_type $msgs
     */
    public function __construct(Zend_Form_Element $elem, Zend_Form $form, $msgs = null) {
        $this->_form = $form;
        $this->_zqmessages = $msgs;
       	foreach (get_object_vars($elem) as $key => $name) {
       		$this->$key = $name;
       	}
    }
    
    /**
     * Returns an array of ZQueryFormValidation_Validator_Base object from Zend_Validators used by this element
     * @return array 
     */
    private function _getZQueryFormValidators() {
    	if (isset($this->_zqvalidators)) return $this->_zqvalidators;
    	
    	$this->_zqvalidators = array();

    	foreach ($this->getValidators() as $validator) {
    		// try to load appropriate ZQueryFormValidation class
    		$validatorShortName = end(explode('_', get_class($validator)));
    		$class = 'ZQueryFormValidation_Validator_'.$validatorShortName;
    	
    		if (@class_exists($class, true)) {
    			$v = new $class($validator, $this->_form);
    			$this->_zqvalidators[get_class($validator)] = $v;
    		}
    	}
    	return $this->_zqvalidators;
    }
     
    /**
     * Returns an array of new jQueryValidate functions introduced for this element or an empty array if no functions have been created
     * @return array
     */
    public function getJQVFunctionsCreated() {
    	return isset($this->_jqvFunctionsCreated) ? $this->_jqvFunctionsCreated : array();
    }

    /**
     * Renders rules used by this element
     * @return string
     */
    public function renderRules(array $forceRules = null) {
        $valResult = '';
        $usedRules = array();
        // render code for isRequired
        if ($this->isRequired())
        	$valResult = 'required:true,';
        
        // force rules?
        if (!empty($forceRules)) {
			foreach ($forceRules as $rule) {
				$rule = trim($rule,', ');
				$valResult .= $rule . ',';
			}
        } 
        foreach ($this->_getZQueryFormValidators() as $validator) {
   	    	foreach ($validator->getRulesUsed() as $usedRule) {
   	    		if (key_exists($usedRule, $usedRules)) {
   	    		    if ($usedRule != 'pattern') 
   	    		        throw new Exception('Used rule "' . $usedRule . '" multiple times in form element ' . $this->getName() . ' - can only use rule "pattern" multiple times');
   	    		    $fName = str_replace(' ', '', $this->getName() . 'Fctn' . $usedRules[$usedRule]); 
   	    		    $newFctn = 'jQuery.validator.addMethod("'.$fName.'", function(value, element) {x = this.optional(element) || '.$validator->getPatternUsed().'.test(value); console.log("'.$fName.' - " + x + " - " + this.optional(element) + " - " + value); return x;}, "Invalid format.");';
   	    		    $valName = strtolower(end(explode('_', get_class($validator))));
   	    		    $this->_jqvFunctionsCreated[$valName]['name'] = $fName;
   	    		    $this->_jqvFunctionsCreated[$valName]['fctn'] = $newFctn;
   	    		    $usedRules[$usedRule] = $usedRules[$usedRule] + 1;
   	    		    $valResult .= $fName . ':true,';
   	    		} else { 
   	    		    $usedRules[$usedRule] = 1;
   	    			$valResult .= trim($validator->render());
   	    		}
   	    	}
    	}
      	return (empty($valResult) ? '' : $this->getName() . ':{' . trim($valResult, ',') . '},');
    }

    /**
     * Renders messages defined for this element
     * @return string
     */
    public function renderMessages() {
        // messages set? 
        if (!isset($this->_zqmessages)) return '';
        
       	$msgs = $this->getName() . ':{';
       	$hit = false;
       	foreach ($this->_zqmessages as $filter => $msg) {
	       	$msg = str_replace('"',"'",$msg);
        	// message 'all' set? if so, return this message
	       	if (strtolower($filter) == 'all')
	       		return $this->getName() . ':"' . $msg . '",';
	       	elseif (strtolower($filter) == 'required' && $this->isRequired()) {
	       	    $hit = true;
	       	    $msgs .= 'required:"' . $msg . '",';
	       	}
	       	else {
	       	    // check if validator exists for defined message?
	       	    $v = $this->getValidator($filter);
	       	    if ($v !== false) {
	       	    	$validators = $this->_getZQueryFormValidators();
	       	    	$zqValidator = @$validators['Zend_Validate_' . ucfirst($filter)];
	       	    	if (isset($zqValidator)) {
	       	    	    if (is_array($this->_jqvFunctionsCreated) && key_exists($filter, $this->_jqvFunctionsCreated))
	       	    	        $msgs .= $this->_jqvFunctionsCreated[$filter]['name'] . ':"' . $msg . '",';
	       	    	    else foreach ($zqValidator->getRulesUsed() as $rule) {
	       	    	        $hit = true;
	       	    		    $msgs .= $rule . ':"' . $msg . '",';
	       	    		}
	       	    	}
	       	    }
	       	}
       	}
       	return ($hit ? trim($msgs, ',') . '},' : '');
    }
}