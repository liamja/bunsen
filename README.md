# Bunsen
A test framework for [CodeIgniter] 2.*

Bunsen patches the CodeIgniter core before it bootstraps to load global classes that would be otherwise unavailable to PHPUnit.
Because of this runtime patching, no permenant modifications have to be made to CodeIgniter's core, meaning you can freely update to newer versions. 


## Acknowledgments
* [Patchwork] is used to perform the patching.
* Heavily inspired by [codeigniter-phpunit].


## License
Bunsen is [MIT licensed](LICENSE.md).


[CodeIgniter]: https://www.codeigniter.com
[codeigniter-phpunit]: https://github.com/fmalk/codeigniter-phpunit/tree/2.x
[Patchwork]: http://antecedent.github.io/patchwork 
