<?php
namespace Market\Form;
use Laminas\Form\Form;
use Laminas\Form\Element\{
    Select,
    Text,
    Textarea,
    Radio,
    Email,
    Captcha,
    Submit
};

use Laminas\Captcha\Image as ImageCaptcha;
use Laminas\InputFilter\InputFilterInterface;

class PostForm extends Form
{
    protected array $categories;
    protected array $expireDays;
    protected array $captchaOptions;
    public function __construct($categories, $expireDays, $captchaOptions, InputFilterInterface $filter)
    {
        parent::__construct(__CLASS__);
        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter);

        $category = new Select('category');
        $category->setLabel('Category ')
            ->setAttribute('title', 'Please select a category')
            ->setValueOptions(array_combine($categories, $categories))
            ->setLabelAttributes(['style' => 'display: block']);

        $title = new Text('title');
        $title->setLabel('Title ')
            ->setAttribute('placeholder', 'Enter posting title')
            ->setLabelAttributes(['style'=>'display:block']);

        $photo = new Text('photo_filename');
        $photo->setLabel('Photo file ')
            ->setAttribute('maxlength', 1024)
            ->setAttribute('placeholder', 'Enter image URL')
            ->setLabelAttributes(['style'=>'display:block']);

        $price = new Text('price');
        $price->setLabel('Price ')
            ->setAttribute('title', 'Enter price as nnn.nn')
            ->setAttribute('size', 16)
            ->setAttribute('maxlength', 16)
            ->setAttribute('placeholder', 'Enter a value')
            ->setLabelAttributes(['style'=>'display:block']);

        $expires = new Radio('expires');
        $expires->setLabel('Expires ')
            ->setAttribute('title', 'The expiration date will be calculated from today')
            ->setAttribute('class', 'expiresButton')
            ->setValueOptions($expireDays);

        $city = new Text('cityCode');
        $city->setLabel('Nearest city, country code ')
            ->setAttribute('title', 'Enter as "city,country" use two letter ISO code for country')
            ->setAttribute('id', 'cityCode')
            ->setAttribute('placeholder', 'City name, country code')
            ->setLabelAttributes(['style'=>'display:inline']);

        $name = new Text('contact_name');
        $name->setLabel('Contact name ')
            ->setAttribute('title', 'Enter the name of the person to contact for this item')
            ->setAttribute('size', 40)
            ->setAttribute('maxlength', 255)
            ->setLabelAttributes(['style'=>'display:block']);

        $phone = new Text('contact_phone');
        $phone->setLabel('Contact phone number ')
            ->setAttribute('title', 'Enter the phone number of the person to contact for this item')
            ->setAttribute('size', 20)
            ->setAttribute('maxlength', 32)
            ->setLabelAttributes(['style'=>'display:block']);

        $email = new Email('contact_email');
        $email->setLabel('Contact email ')
            ->setAttribute('title', 'Enter the email address of the person to contact for this item')
            ->setAttribute('size', 40)
            ->setAttribute('maxlength', 255)
            ->setLabelAttributes(['style'=>'display:block']);

        $description = new Textarea('description');
        $description->setLabel('Description ')
            ->setAttribute('title', 'Enter a posting description')
            ->setAttribute('rows', 4)
            ->setAttribute('cols', 120);

        $delCode = new Text('delete_code');
        $delCode->setLabel('Delete code ')
            ->setAttribute('title', 'Enter the delete code for this item')
            ->setAttribute('size', 16)
            ->setAttribute('maxlength', 16);

        $captcha = new Captcha('captcha');
        $captchaAdapter = new ImageCaptcha();
        $captchaAdapter->setWordlen(4)
            ->setOptions($captchaOptions);
        $captcha->setCaptcha($captchaAdapter)
            ->setLabel('Help us to prevent SPAM!')
            ->setAttribute('title', 'Help to prevent SPAM');

        $submit = new Submit('submit');
        $submit->setAttribute('value', 'Post')
               ->setAttribute('style', 'font-size: 16pt; font-weight:bold;')
               ->setAttribute('class', 'btn btn-success white');

        $this->add($category)
            ->add($title)
            ->add($photo)
            ->add($price)
            ->add($expires)
            ->add($city)
            ->add($name)
            ->add($phone)
            ->add($email)
            ->add($description)
            ->add($delCode)
            ->add($captcha)
            ->add($submit);
    }
}
