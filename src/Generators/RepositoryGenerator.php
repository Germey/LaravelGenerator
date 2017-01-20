<?php

namespace Germey\Generator\Generators;

use Germey\Generator\Common\CommandData;
use Germey\Generator\Utils\FileUtil;

class RepositoryGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $fileName;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
        $this->path = $commandData->config->pathRepository;
        $this->fileName = $this->commandData->modelName.'Repository.php';
    }

    public function generate()
    {
        $templateData = get_template('repository', 'generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        $searchables = [];

        foreach ($this->commandData->fields as $field) {
            if ($field->isSearchable) {
                $searchables[] = "'".$field->name."'";
            }
        }

        $templateData = str_replace('$FIELDS$', implode(','.generator_nl_tab(1, 2), $searchables), $templateData);

        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\nRepository created: ");
        $this->commandData->commandInfo($this->fileName);
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            $this->commandData->commandComment('Repository file deleted: '.$this->fileName);
        }
    }
}
