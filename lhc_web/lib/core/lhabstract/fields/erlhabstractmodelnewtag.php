<?php

$departmentFilterdefault = erLhcoreClassUserDep::conditionalDepartmentFilter();

return array(
    'id' => array(
        'type' => 'text',
        'trans' => erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/product','ID'),
        'required' => false,
        'width' => 1,
        'hide_edit' => true,
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'tag' => array(
        'type' => 'text',
        'trans' => erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/proactivechatinvitation', 'Tag'),
        'required' => true,
        'placeholder' => 'tag',
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
    'intent' => array(
        'type' => 'text',
        'trans' => erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/chatsubject','Intent'),
        'required' => true,
        'placeholder' => 'intent',
        'validation_definition' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        )),
);