<?php

namespace GanttDashboard\App\Validators;

use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\Callback;
use GanttDashboard\App\Models\Workers;

class Worker extends Base
{
    /**
     * Constructs the validations for model
     */
    public function __construct()
    {
        $this->add(
            'submit',
            new PresenceOf([
                'cancelOnFail' => true,
            ])
        );

        $this->add(
            ['firstName', 'lastName', 'email'],
            new PresenceOf([
                'message' => [
                    'firstName' => 'The First Name is required.',
                    'lastName' => 'The Last Name is required.',
                    'email' => 'The e-mail is required.'
                    ]
            ])
        );

        $this->add(
            'email',
            new Callback([
                'callback' => function ($data) {
                    if (strlen($data['email']) > 0) {
                        return new Email([
                            'message' => 'The e-mail is not valid.',
                        ]);
                    }

                    return true;
                }
            ])
        );

        $this->add(
            'email',
            new Callback([
                'callback' => function ($data) {
                    if (false === isset($data['id'])) {
                        new Uniqueness([
                            'model'   => new Workers(),
                            'message' => 'This email is already registered.',
                        ]);
                    }

                    return true;
                }
            ])
        );
    }
}
