<?php namespace Leinbach\Generators\Generators;

use Illuminate\Filesystem\Filesystem as File;

class ModelGenerator {

	protected $file;

	public function __construct(File $file)
	{
		$this->file = $file;	
	}
	
	public function make($path)
	{
		$name = basename($path, '.php');
		$template = $this->getTemplate($name);
		
		if (! $this->file->exists($path))
		{
			return $this->file->put($path,$template);
		}
		
		return false;
	}
	
	public function getTemplate($name) 
	{
		$template = $this->file->get(__DIR__.'/templates/model.txt');
		
		return str_replace('{{name}}', $name, $template);
	}
}