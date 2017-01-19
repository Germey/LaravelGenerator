<?php

namespace Germey\Generator\Commands\API;

use Germey\Generator\Commands\BaseCommand;
use Germey\Generator\Common\CommandData;
use Germey\Generator\Generators\API\APITestGenerator;
use Germey\Generator\Generators\RepositoryTestGenerator;
use Germey\Generator\Generators\TestTraitGenerator;

class TestsGeneratorCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generator.api:tests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create tests command';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->commandData = new CommandData($this, CommandData::$COMMAND_TYPE_API);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();

        $repositoryTestGenerator = new RepositoryTestGenerator($this->commandData);
        $repositoryTestGenerator->generate();

        $testTraitGenerator = new TestTraitGenerator($this->commandData);
        $testTraitGenerator->generate();

        $apiTestGenerator = new APITestGenerator($this->commandData);
        $apiTestGenerator->generate();

        $this->performPostActions();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge(parent::getOptions(), []);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), []);
    }
}
