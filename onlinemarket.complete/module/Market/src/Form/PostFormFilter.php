<?php
namespace Market\Form;
use Laminas\InputFilter\ {InputFilter,Input};
use Laminas\Validator\ {Regex, Callback as CallValid};
use Laminas\Filter\ {Digits, StripTags, StringTrim, ToFloat};

class PostFormFilter extends InputFilter
{
    public function __construct(array $categories, array $expireDays)
    {
        $category = new Input('category');
        $category->getFilterChain()
                 ->attachByName('StringToLower');
        $category->getValidatorChain()
                 ->attachByName('InArray', array('haystack' => $categories));

        $title = new Input('title');
        $titleRegex = new Regex(array('pattern' => '/^[a-zA-Z0-9 ]*$/'));
        $titleRegex->setMessage('Title should only contain numbers, letters or spaces!');
        $title->getValidatorChain()
              ->attach($titleRegex)
              ->attachByName('StringLength', array('min' => 1, 'max' => 128));

        $photo = new Input('photo_filename');
        $photo->getValidatorChain()
              ->attachByName('Regex', array('pattern' => '!^(http(s)?://)?[a-z0-9./_-]+(jp(e)?g|png)$!i'));
        $photo->setErrorMessage(
            'Photo must be a URL or a valid filename ending with jpg or png.  '
            . 'TO NOTICE: this error message overrides the default message associated with the validator.'
        );

        $price = new Input('price');
        $price->getValidatorChain()
            ->attachByName('GreaterThan', array('min' => 0.00))
            ->attachByName('NotEmpty');
        $price->getFilterChain()
            ->attach(new ToFloat()
        );

        $expires = new Input('expires');
        $expires->getValidatorChain()
            ->attachByName('InArray', ['haystack' => array_keys($expireDays)])
            ->attachByName('NotEmpty');
        $expires->getFilterChain()
                ->attach(new Digits());

        // validates "city" field
        $cityCheck = new CallValid(function ($val) {
            if (!strpos($val, ',')) return FALSE;
            [$city, $country] = explode(',', $val);
            if ($city === NULL || $country === NULL) return FALSE;
            if (strlen($country) != 2) return FALSE;
            if ($country !== strtoupper($country)) return FALSE;
            return TRUE;
        });
        $cityCheck->setMessage('What you entered did take this form: NNNN,CC where NNNN = the city name, and CC = 2 digit ISO country code');
        $cityCode = new Input('cityCode');
        $cityCode->getValidatorChain()
                 ->attach($cityCheck);

        $name = new Input('contact_name');
        $name->getValidatorChain()
            ->attachByName('Regex', ['pattern' => '/^[a-z0-9., -]{1,255}$/i'])
            ->attachByName('NotEmpty');
        $name->setErrorMessage('Name should only contain letters, numbers, and some punctuation.');

        $phone = new Input('contact_phone');
        $phone->getValidatorChain()
            ->attachByName('Regex', array('pattern' => '/^\+?\d{1,4}(-\d{3,4})+$/'))
            ->attachByName('NotEmpty');
        $phone->setErrorMessage('Phone number must be in this format: +nnnn-nnn-nnn-nnnn');

        $email = new Input('contact_email');
        $email->getValidatorChain()
            ->attachByName('EmailAddress')
            ->attachByName('NotEmpty');

        $description = new Input('description');
        $description->getValidatorChain()
            ->attachByName('StringLength', array('min' => 1, 'max' => 4096))
            ->attachByName('NotEmpty');

        $delCode = new Input('delete_code');
        $delCode->setRequired(TRUE);
        $delCode->getValidatorChain()
                ->attachByName('Digits');

        $this->add($category)
             ->add($title)
             ->add($photo)
             ->add($price)
             ->add($expires)
             ->add($cityCode)
             ->add($name)
             ->add($phone)
             ->add($email)
             ->add($description)
             ->add($delCode);

        // add StripTags + StringTrim to all
        $stripTags = new StripTags();
        $stringTrim = new StringTrim();
        foreach ($this->getInputs() as $input) {
            $input->getFilterChain()
                  ->attach($stripTags)
                  ->attach($stringTrim);
        }
    }
}
