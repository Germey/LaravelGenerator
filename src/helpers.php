<?php

if (!function_exists('generator_tab')) {
    /**
     * Generates tab with spaces.
     *
     * @param int $spaces
     *
     * @return string
     */
    function generator_tab($spaces = 4)
    {
        return str_repeat(' ', $spaces);
    }
}

if (!function_exists('generator_tabs')) {
    /**
     * Generates tab with spaces.
     *
     * @param int $tabs
     * @param int $spaces
     *
     * @return string
     */
    function generator_tabs($tabs, $spaces = 4)
    {
        return str_repeat(generator_tab($spaces), $tabs);
    }
}

if (!function_exists('generator_nl')) {
    /**
     * Generates new line char.
     *
     * @param int $count
     *
     * @return string
     */
    function generator_nl($count = 1)
    {
        return str_repeat(PHP_EOL, $count);
    }
}

if (!function_exists('generator_nls')) {
    /**
     * Generates new line char.
     *
     * @param int $count
     * @param int $nls
     *
     * @return string
     */
    function generator_nls($count, $nls = 1)
    {
        return str_repeat(generator_nl($nls), $count);
    }
}

if (!function_exists('generator_nl_tab')) {
    /**
     * Generates new line char.
     *
     * @param int $lns
     * @param int $tabs
     *
     * @return string
     */
    function generator_nl_tab($lns = 1, $tabs = 1)
    {
        return generator_nls($lns).generator_tabs($tabs);
    }
}

if (!function_exists('get_template_file_path')) {
    /**
     * get path for template file.
     *
     * @param string $templateName
     * @param string $templateType
     *
     * @return string
     */
    function get_template_file_path($templateName, $templateType, $templateSpace='germey')
    {
        $templateName = str_replace('.', '/', $templateName);
	    $templateType = str_replace('.', '/', $templateType);

        $templatesPath = config(
            'generator.path.templates_dir',
            base_path('resources/generator/templates/')
        );

        $path = $templatesPath.$templateName.'.stub';

        if (file_exists($path)) {
            return $path;
        }

        return base_path('vendor/'.$templateSpace.'/'.$templateType.'/templates/'.$templateName.'.stub');
    }
}

if (!function_exists('get_template')) {
    /**
     * get template contents.
     *
     * @param string $templateName
     * @param string $templateType
     *
     * @return string
     */
    function get_template($templateName, $templateType, $templateSpace='germey')
    {
        $path = get_template_file_path($templateName, $templateType, $templateSpace);

        return file_get_contents($path);
    }
}

if (!function_exists('fill_template')) {
    /**
     * fill template with variable values.
     *
     * @param array  $variables
     * @param string $template
     *
     * @return string
     */
    function fill_template($variables, $template)
    {
        foreach ($variables as $variable => $value) {
            $template = str_replace($variable, $value, $template);
        }

        return $template;
    }
}

if (!function_exists('fill_field_template')) {
    /**
     * fill field template with variable values.
     *
     * @param array                                   $variables
     * @param string                                  $template
     * @param \Germey\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_field_template($variables, $template, $field)
    {
        foreach ($variables as $variable => $key) {
            $template = str_replace($variable, $field->$key, $template);
        }

        return $template;
    }
}

if (!function_exists('fill_template_with_field_data')) {
    /**
     * fill template with field data.
     *
     * @param array                                   $variables
     * @param array                                   $fieldVariables
     * @param string                                  $template
     * @param \Germey\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_template_with_field_data($variables, $fieldVariables, $template, $field)
    {
        $template = fill_template($variables, $template);

        return fill_field_template($fieldVariables, $template, $field);
    }
}

if (!function_exists('fill_template_with_field_data')) {
    /**
     * fill template with field data.
     *
     * @param array                                   $variables
     * @param array                                   $fieldVariables
     * @param string                                  $template
     * @param \Germey\Generator\Common\GeneratorField $field
     *
     * @return string
     */
    function fill_template_with_field_data($variables, $fieldVariables, $template, $field)
    {
        $template = fill_template($variables, $template);

        return fill_field_template($fieldVariables, $template, $field);
    }
}

if (!function_exists('model_name_from_table_name')) {
    /**
     * generates model name from table name.
     *
     * @param string $tableName
     *
     * @return string
     */
    function model_name_from_table_name($tableName)
    {
        return ucfirst(camel_case(str_singular($tableName)));
    }
}
