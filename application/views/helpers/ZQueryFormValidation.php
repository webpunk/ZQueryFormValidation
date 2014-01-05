<?php
/*
 --------------------------------------------------------------------
 ! ZQueryFormValidation - auto generate client side form validation !
 --------------------------------------------------------------------

Requirements: 
- Zend Framework (tested with V1.12)
- JQuery (tested with V1.10)
- jQuery Validation Plugin (see http://jqueryvalidation.org/ - tested with V1.11.1)

Copyright (c) 2013-2014 by Christian KONCILIA

http://www.web-punk.com

All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice,
this list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
		LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

/**
* ZQueryFormValidation. Automatically generate client side form validation from
* your Zend_Form validators.
*
* See README.md / manual.html for a brief documentation, a how-to-use and a list of 
* not-yet-implemented features. 
*
* @package ZQueryFormValidation
* @author Christian Koncilia
* @copyright Copyright (c) 2013-2014 Christian Koncilia. (http://www.web-punk.com)
* @license New BSD License (see above)
* @version V.0.4
*/
class Curlytop_View_Helper_ZQueryFormValidation extends Zend_View_Helper_Abstract
{
    /**
     * Renders form validations for jqueryvalidation plugin (see http://jqueryvalidation.org/)
     * @param Zend_Form $form the form for which a jqueryvalidation will be gerated and rendered
     * @param Array $options. Key => Value array. Keys supported: 
     *        'showWarnings' => true/false (guess what... show warnings yes/no)
     *        'inject' => filename (File that holds additional jqueryvalidation options which will be rendered right after the messages section and before the rules section of the generated javascript code)
     */
    public function ZQueryFormValidation(Zend_Form $form, array $options = null)
    {
        $formValidator = new ZQueryFormValidation_Form($form);
        return $formValidator->render($this->view, $options);
    }
}