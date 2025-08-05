<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$this->CI = &get_instance();
$this->CI->load->library('captchalib');
$this->CI->load->helper('custom');


$config['contact_us'] = array(

    'email_title' => array( /* HIDDEN */
        'id'            => 'email_title',
        'type'          => 'hidden',
        'value'         => 'New Inquiry from Contact US',
        'mail_response' => lang('thanks_for_contacting_us'),
    ),
    'name'        => array(
        'id'          => 'name',
        'placeholder' => lang('enter_your_name'),      
        'autocomplete' => 'off',    
        'validation'  => 'trim|required|xss_clean',
    ),
    'email'       => array(
        'id'          => 'email',
        'type'        => 'email',
        'placeholder' => lang('enter_your_email'),
        'autocomplete' => 'off',
        'validation'  => 'trim|required|valid_email|xss_clean',
    ),
    'subject'     => array(
        'id'          => 'subject',
        'placeholder' => lang('enter_subject'),
        'autocomplete' => 'off', 
        'validation'  => 'trim|required|xss_clean',
    ),
    'description' => array( /* TEXTAREA */
        'id'          => 'description',
        'type'        => 'textarea',
        'placeholder' => lang('enter_description'),
    ),
    'submit'      => array( /* SUBMIT */
        'id'   => 'submit',
        'type' => 'submit',
        'value' => 'submit',
    ),
);

$config['complain'] = array(
    
    'email_title' => array( /* HIDDEN */
        'id'            => 'email_title',
        'type'          => 'hidden',
        'value'         => 'New Inquiry from Complain',
        'mail_response' => lang('thank_you_for_your_complain'),
    ),
    'name'        => array(
        'id'          => 'name',
        'placeholder' => lang('enter_your_name'),
        'validation'  => 'trim|required|xss_clean',
    ),
    'email'       => array(
        'id'          => 'email',
        'type'        => 'email',
        'placeholder' => lang('enter_your_email'),
        'validation'  => 'trim|required|valid_email|xss_clean',
    ),
    'contact_no'  => array(
        'id'          => 'contact_no',
        'placeholder' =>  lang('enter_contact_number'),
        'validation'  => 'trim|required|xss_clean',
    ),
    'description' => array( /* TEXTAREA */
        'id'          => 'description',
        'type'        => 'textarea',
        'placeholder' => lang('enter_description'),
    ),

    'submit'      => array( /* SUBMIT */
        'id'   => 'submit',
        'type' => 'submit',
        'value' => 'submit',
    ),
);
$is_captcha_complain = $this->CI->captchalib->is_captcha('complain');

if ($is_captcha_complain) {
    $complain_captcha = array( /* TEXTAREA */
        'id'          => 'captcha',
        'type'        => 'captcha',
        'placeholder' => lang('enter_captcha'),
        'validation'  => 'trim|required|xss_clean|callback_check_captcha',
    );
    array_insert(
        $config['complain'],
        'submit',
        [
            'captcha' => $complain_captcha,
        ]
    );

}
$is_captcha_contact_us = $this->CI->captchalib->is_captcha('contact_us');

if ($is_captcha_contact_us) {
    $contact_us_captcha = array( /* TEXTAREA */
        'id'          => 'captcha',
        'type'        => 'captcha',
        'placeholder' => lang('enter_captcha'),
        'validation'  => 'trim|required|xss_clean|callback_check_captcha',
    );
    array_insert(
        $config['contact_us'],
        'submit',
        [
            'captcha' => $contact_us_captcha,
        ]
    );

}
