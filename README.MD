Simple implementation of pipeline in php, you can use this library to pipe a series of functions and/or classes to be executed sequentialy, piped also supports breaking out of pipeline and reverting.

#### installation

use the following command to add Piped to your projects:

`composer require arashrasoulzadeh/piped`

#### Definition

- Pipe : an execution sequence class (extend the `arashrasoulzadeh\piped\Abstracts\Pipe` and override `command` method)

#### Extend

You should create new Pipe Class that extends `arashrasoulzadeh\piped\Abstracts\Pipe` and override `command` method. there are some parametters you can override :

- `rollback` enable revert the pipe if an error occured.

- `throw_error` enable this to throw error insted of executing the rest of the pipe

- `custom_args` arguments that passed as the second input of pipe array, refer to usage for more info

#### Usage

After declaring new pipes ( or you may use the Piped pipes) , you can use the following code snipper to call a Pipeline:

```php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\SumAllPipe;

$pipe =  Piped::build()->pipe(1,2,3,4)->through(
	SumAllPipe::class,
);

echo $pipe->output(); // 10

```

you may also pass custom arguments to pipe ( can be accessed by `custom_args` array in the pipe) like :

```php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\ConcatAllPipe;

$pipe =  Piped::build()->pipe(1,2,3,4)->through(
	[ ConcatAllPipe::class,'-' ],
);

echo $pipe->output(); // 1-2-3-4

```

you can provide unlimited numbers of pipes in `through` method, like :

```php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\ConcatAllPipe;

$pipe =  Piped::build()->pipe(1,2,3,4)->through(
	[ NotNullPipe::class , '*' ],
	[ ConcatAllPipe::class,'-' ]
);

echo $pipe->output(); // 1-2-3-4

```

#### Available pipes

There are some pre-build Pipes in the library:

- ConcatAllPipe : concatenate all inputs together using provided custom argument ( space as deafult )

- SumAllPipe : sum all input numbers

- NotNullPipe : check if all/some/first input item is null,if so break the pipeline. you may prvide `*` for all items, or an array of indexes for checking ( default is first index )
