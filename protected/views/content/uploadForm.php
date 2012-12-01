<?php

return array(
    'title' => 'Upload your image',

    'attributes' => array(
        'enctype' => 'multipart/form-data',
    ),

    'elements' => array(
        'text' => array(
            'type' => 'file',
            'label' => 'File',
        ),
    ),

    'buttons' => array(
        'reset' => array(
            'type' => 'reset',
            'label' => 'Reset',
        ),
        'submit' => array(
            'type' => 'submit',
            'label' => 'Upload',
        ),
    ),
);