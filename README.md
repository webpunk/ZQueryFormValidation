ZQueryFormValidation - auto generate client side form validation
================================================================

What is ZQueryFormValidation?
-------------
**Short version**: ZQueryFormValidation automatically generates client side form validation based on the validators (Zend_Validator) that you defined in your server side form (Zend_Form) implementation.

**Longer version**: Writing code twice is simply annoying. But that is basically exactly what you'll have to do, if you implement forms that should be validated on both the server and the client side. 

ZQueryFormValidation is a small tool that automatically generates Javascript code from the validators you use in your Zend_Form (e.g. Zend_Validate_Alnum, Zend_Validate_Between, Zend_Validate_CreditCard, Zend_Validate_EmailAddress, etc.)  
using the [jQuery Validation Plugin](http://jqueryvalidation.org/) implemented by J. Zaefferer.

Let's have a look at an example. First, you define your form as you always do using Zend_Form:

```php
class Application_Form_ZQueryExampleForm extends Zend_Form
{
    public function init()
    {
        $this->setAction('/my/action');
   		$this->setName('signupform');

        $this->addElement('text', 'email', array(
            'required'		=> true,
            'validators' => array(
            	array('validator' => 'EmailAddress')
            )
        ));

        $this->addElement('text', 'URL', array(
                'description' => 'Provide a valid hostname',
                'validators' => array(
        				array('validator' => 'Hostname')
        		)
        ));
       
        $this->addElement('password', 'password', array(
                'required'		=> true,
                'description'   => 'Your password (4 - 20 characters / Digits / Characters)',
        		'validators' => array(
          				array('Regex', true, array('pattern' => '/^[A-Za-z0-9\w]{4,20}/'))
        		)
        ));
        $this->addElement('password', 'passwordRepeat', array(
        		'required'		=> true,
                'description'	=> 'Repeat your password',
                'validators' => array(
        				array('identical', false, array('token' => 'password'))
        		)
        ));

        $this->addElement('checkbox', 'tou', array(
        		'required'		=> true,
        		'label'	=> 'I have read and accept the Terms of Use.'
        ));

        $this->addElement('button', 'submit', array(
            'label'         => 'Login',
            'type'          => 'submit'
        ));
    }
}
```
 
Please note, that there is **no need to change anything** in your form! This is just good old fashioned Zend_Form code. All you have to do is to use the ZQueryFormValidation View-Helper in your view:

```php
<h1>Signup Form</h1>
<?php 
	echo $this->form->render();
	echo $this->ZQueryFormValidation($this->form); 
?>
```

This will automatically create a javascript code and inject it into your HTML which will take care of the corresponding client side validation. For the example give above, this view helper will create the following JavaScript code

```html
$("#signupform").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        URL: {
            url: true
        },
        password: {
            required: true,
            pattern: /^[A-Za-z0-9\w]{4,20}/
        },
        passwordRepeat: {
            required: true,
            equalTo: "#password"
        },
        tou: {
            required: true
        }
    }
});
```

Manual
------
Have a look at the full [manual here](http://www.web-punk.com/?attachment_id=816)

Questions?
----------
Got questions? Please contact me using the contact form on [my blog...](http://www.web-punk.com/) 