<?php

namespace Germey\Generator\Utils;

use Germey\Generator\Common\GeneratorField;

class HTMLFieldGenerator
{
    public static function generateHTML(GeneratorField $field, $templateType, $templateSpace='germey')
    {
        $fieldTemplate = '';

        switch ($field->htmlType) {
            case 'text':
            case 'textarea':
            case 'date':
            case 'file':
            case 'email':
            case 'password':
                $fieldTemplate = get_template('scaffold.fields.'.$field->htmlType, $templateType, $templateSpace);
                break;
            case 'number':
                $fieldTemplate = get_template('scaffold.fields.'.$field->htmlType, $templateType, $templateSpace);
                break;
            case 'select':
            case 'enum':
                $fieldTemplate = get_template('scaffold.fields.select', $templateType, $templateSpace);
                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $fieldTemplate = str_replace(
                    '$INPUT_ARR$',
                    GeneratorFieldsInputUtil::prepareKeyValueArrayStr($radioLabels),
                    $fieldTemplate
                );
                break;
            case 'checkbox':
                $fieldTemplate = get_template('scaffold.fields.checkbox', $templateType, $templateSpace);
                if (count($field->htmlValues) > 0) {
                    $checkboxValue = $field->htmlValues[0];
                } else {
                    $checkboxValue = 1;
                }
                $fieldTemplate = str_replace('$CHECKBOX_VALUE$', $checkboxValue, $fieldTemplate);
                break;
            case 'radio':
                $fieldTemplate = get_template('scaffold.fields.radio_group', $templateType, $templateSpace);
                $radioTemplate = get_template('scaffold.fields.radio', $templateType, $templateSpace);

                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $radioButtons = [];
                foreach ($radioLabels as $label => $value) {
                    $radioButtonTemplate = str_replace('$LABEL$', $label, $radioTemplate);
                    $radioButtonTemplate = str_replace('$VALUE$', $value, $radioButtonTemplate);
                    $radioButtons[] = $radioButtonTemplate;
                }
                $fieldTemplate = str_replace('$RADIO_BUTTONS$', implode("\n", $radioButtons), $fieldTemplate);
                break;
        }

        return $fieldTemplate;
    }
}
