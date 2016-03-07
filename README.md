# Bunsen
A test framework for [CodeIgniter] 2.*

Bunsen patches the CodeIgniter core before it bootstraps to load global classes that would be otherwise unavailable to PHPUnit.
Because of this runtime patching, no permanent modifications have to be made to CodeIgniter's core, meaning you can freely update to newer versions. 

## Documentation
Documentation can be found in [the docs directory](docs/), or you can [read the documentation online](https://liamja.gitbooks.io/bunsen/content/) in book format.

## Acknowledgements
* [Patchwork] is used to perform the patching.
* Heavily inspired by [codeigniter-phpunit].


## License
Bunsen is [MIT licensed](LICENSE.md).


[CodeIgniter]: https://www.codeigniter.com
[codeigniter-phpunit]: https://github.com/fmalk/codeigniter-phpunit/tree/2.x
[Patchwork]: http://antecedent.github.io/patchwork 
