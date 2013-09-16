<?php
namespace Leinbach\Generators\Commands;

use Leinbach\Generators\Generators\ModelGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModelGeneratorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'generate:model';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a new model.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	 
	protected $generator;
	
	public function __construct(ModelGenerator $generator)
	{
		parent::__construct();
		$this->generator = $generator;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$path = $this->getPath();
		if ($this->generator->make($path) ) {
			return $this->info("Created {$path}");
		} 
		$this->error("Could not create {$path}");
	}
	
	public function getPath() {
		return $this->option('path') .'/'. ucwords($this->argument('name')) .'.php';
	}
	

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'The name of the model'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('path', 'p', InputOption::VALUE_OPTIONAL, 'Path to the models directory.', 'app/models'),
		);
	}

}