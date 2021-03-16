<?php
namespace Market\Form;

use Laminas\Form\Element\{
    Hidden,
    Text,
    Captcha,
    Submit
};
use Laminas\Form\Form;
use Laminas\Captcha\Dumb;

class DeleteForm extends Form
{
	public function prepareElements()
	{
		$id = new Hidden('id');
		
		$delCode = new Text('delCode');
		$delCode->setLabel('Delete Code')
			 ->setAttribute('title', 'Enter code needed to delete this posting')
			 ->setAttribute('size', 40)
			 ->setAttribute('maxlength', 128);

		$captcha = new Captcha('captcha');
		$captchaAdapter = new Dumb();
		$captchaAdapter->setWordlen(5);
		$captcha->setCaptcha($captchaAdapter)
			    ->setAttribute('title', 'Help to prevent SPAM');
		
		$submit = new Submit('submit');
		$submit->setAttribute('value', 'Delete')
			   ->setAttribute('title', 'Click here to delete this item');
		
		$cancel = new Submit('cancel');
		$cancel->setAttribute('value', 'Cancel')
			   ->setAttribute('title', 'Click here to cancel deletion');
		
		$this->add($id)
			 ->add($delCode)
			 ->add($captcha)
			 ->add($submit)
			 ->add($cancel);
	}
} 
