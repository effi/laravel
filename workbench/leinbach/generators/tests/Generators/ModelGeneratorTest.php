<?php 
use Leinbach\Generators\Generators\ModelGenerator;
use Mockery as m;

class ModelGeneratorTest extends PHPUnit_Framework_TestCase{
	
	public function tearDown() {
		m::close();
	}
	
	public function testCanGenerateModelUsingTemplate() {
		$file = m::mock('Illuminate\Filesystem\Filesystem[put]');
		
		$file->shouldReceive('put')
			 ->once()
			 ->with('app/models/Foo.php',
			 		file_get_contents(__DIR__.'/stubs/model.txt'));
		
		$generator = new ModelGenerator($file);
		$generator->make('app/models/Foo.php');
		
	}
}