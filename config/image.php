<?php
return array(
    'upload_path' => public_path() . '/upload/',
    'quality' => 100,
    'rules'    => array(
        'files' => 'required|mimes:svg,png,jpeg,jpg|max:6150', //~6MB
    ),
);
