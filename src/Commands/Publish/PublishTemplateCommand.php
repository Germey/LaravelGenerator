<?php

namespace Germey\Generator\Commands\Publish;

class PublishTemplateCommand extends PublishBaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generator.publish:templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes api generator templates.';

    private $templatesDir;

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->templatesDir = config(
            'generator.path.templates_dir',
            base_path('resources/generator/templates/')
        );

        if ($this->publishGeneratorTemplates()) {
            $this->publishScaffoldTemplates();
        }
    }

    /**
     * Publishes templates.
     */
    public function publishGeneratorTemplates()
    {
        $templatesPath = __DIR__.'/../../../templates';

        return $this->publishDirectory($templatesPath, $this->templatesDir, 'templates');
    }

    /**
     * Publishes templates.
     */
    public function publishScaffoldTemplates()
    {
        $templateType = config('generator.templates', 'core-templates');

        $templatesPath = base_path('vendor/generator/'.$templateType.'/templates/scaffold');

        return $this->publishDirectory($templatesPath, $this->templatesDir.'/scaffold', 'templates/scaffold', true);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}
