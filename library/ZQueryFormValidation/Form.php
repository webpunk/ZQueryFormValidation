<?php 
/**
 * ZQueryFormValidation_Form. Core Class of ZQueryFormValidation. Renders the JavaScript code. 
 *
 * @package ZQueryFormValidation
 * @author Christian Koncilia
 * @copyright Copyright (c) 2013-2014 Christian Koncilia. (http://www.web-punk.com)
 * @license New BSD License (see above)
 * @version V.0.4
 */
class ZQueryFormValidation_Form {
	private $_form;
    
	/**
	 * Constructor.
	 * @param Zend_Form $form the form that serves as input
	 */
    public function __construct(Zend_Form $form) {
        $this->_form = $form;
	}
	
	/**
	 * renders the JavaScript code
	 * @param Zend_View $view the view used to render the form
	 * @param array $options an Array of options. Valid keys are: 'inject' and 'showWarnings' (see manual) 
	 */
	public function render(Zend_View $view, array $options = null) {
	    // check options used...
    	$inject = (isset($options['inject']) ? file_get_contents($options['inject']) . PHP_EOL : '');
	    $showWarnings = (isset($options['showWarnings']) ? (boolean) $options['showWarnings'] : false);

	    // are messages defined in the file injected?
	    $injectsMessages = (!empty($inject) && preg_match('/messages[\s\t\r\n]*:[\s\t\r\n]*/i', $inject)); 

	    if ($this->_form->getId())
	    	$this->_formSelector = '#' . $this->_form->getId();
	    else
	    	$this->_formSelector = 'form';

	    $result = '$("' . $this->_formSelector . '").validate({' . ($injectsMessages ? '' : '__MESSAGES__') . $inject . '__RULES__});';
	    $messages = '';
	    $rules = '';
	    $jqvFunctions = array();
	    foreach ($this->_form->getElements() as $elem) {
	        $elemName = $elem->getName();
	        if (!isset($elemName)) continue;
	        if (isset($elem->zq_ignore) && $elem->zq_ignore) continue;

	        $felem = new ZQueryFormValidation_Form_Element($elem, $this->_form, $elem->zq_messages);
	        $rules .= $felem->renderRules($elem->zq_forcerules);
	        $messages .= $felem->renderMessages();
	         
	        $jqvFunctions = array_merge($jqvFunctions, $felem->getJQVFunctionsCreated());	        
	    }
	    // no rules assigned to this form?
	    if (empty($rules)) {
	    	if ($showWarnings) trigger_error('No validators assigned to form ' . $this->_form->getName() . '.', E_USER_WARNING);
	    	return;
	    }
	    
	    if (!empty($messages)) $messages = 'messages:{' . trim($messages, ',') . '},';
	    $rules = 'rules:{' . trim($rules, ',') . '}';
	     
        $result = str_replace('__MESSAGES__', $messages, $result);
        $result = str_replace('__RULES__', $rules, $result);
        
        $fctnsString = '';
        foreach ($jqvFunctions as $f) {
        	$fctnsString .= $f['fctn']; 
        }
        $result = $fctnsString . $result;
	    
	    // make sure to render script at the bottom
	    $view->inlineScript()->captureStart();
	    echo "$(document).ready(function () { " . $result . " });";
	    $view->inlineScript()->captureEnd();
	    return $view->inlineScript();
	}
	
}
