ChangeLog
=========

6.0.1 (2024-09-06)
------------------
* #105 Adjust code for things reported by phpstan ( @phil-davis )
* #109 Apply latest cs-fixer changes ( @phil-davis )
* #113 Increase phpstan level to 9 ( @phil-davis )
* #116 Change array<int...> to list<...> in PHP doc ( @phil-davis )
* #120 use php-cs-fixer 3.49 ( @phil-davis )

6.0.0 (2022-08-29)
------------------

* #96 Minor fixes to examples, tests and comments (@phil-davis)
* #97 PHP min version 7.4 (@phil-davis)

5.1.7 (2024-08-27)
------------------

* #132 allow php-cs-fixer major version 3 (@phil-davis)

5.1.6 (2024-07-26)
------------------

* #128 Explicitly mark nullable parameter (@cedric-anne)

5.1.5 (2024-07-25)
------------------

* #125 PHPdoc, CI and test changes to bring 5.1 up to PHP 8.3 (@phil-davis)
* #126 PHP 8.4 compliance (@phil-davis)

5.1.4 (2021-11-04)
------------------

* #93 version bump that was missed in 5.1.3 (@phil-davis)

5.1.3 (2021-11-04)
------------------

* #88 Pass null to $microseconds for null $seconds (@TysonAndre)

5.1.2 (2020-10-03)
------------------

* #82: Added support for PHP 8.0 (@phil-davis)

5.1.1 (2020-09-19)
------------------

* declare experimental php8 support (@TysonAndre)
* incorporated psalm types (@staabm)
* updated build (@phil-davis)

5.1.0 (2020-01-31)
------------------

* Added support for PHP 7.4, dropped support for PHP 7.0 (@phil-davis)
* #49: Updated testsuite for phpunit8, added phpstan coverage (@phil-davis, @DeepDiver1975)

5.0.3 (2018-05-03)
------------------

* Dropped remaining hhvm leftovers.
* #55: Fixed typo in WildcardEmitterTrait (@SamMousa)
* #54: export-ignore examples & tests in distribution (@staabm)

5.0.2 (2017-04-29)
------------------

* #50: Fixed Promise\all to resolve immediately for empty arrays (@MadHed)
* #48, #49: Performance optimisations for EmitterTrait and WildcardEmitterTrait (@lunixyacht).

5.0.1 (2016-10-29)
------------------

* #45: Fixed `Emitter` class to use the correct interface. (@felixfbecker).


5.0.0 (2016-10-23)
------------------

* #42: The `coroutine` function now supports `return` in the passed generator
  function. This allows you to more generally return a value. This is a BC
  break as this is a feature that was only made possible with PHP 7, and
  before the coroutine function would only ever return the last thing that
  was yielded. If you depended on that feature, replace your last `yield` with
  a `return`.


4.0.0 (2016-09-19)
------------------

* sabre/event now requires PHP 7. If you need PHP 5.5 support, just keep
  using 3.0.0.
* PHP 7 type hints are now used everywhere. We're also using strict_types.
* Support for a new `WildcardEmitter` which allows you to listen for events
  using the `*` wildcard.
* Removed deprecated functions `Promise::error` and `Promise::all`. Instead,
  use `Promise::otherwise` and `Promise\all()`.
* `EventEmitter`, `EventEmitterTrait` and `EventEmitterInterface` are now just
  called `Emitter`, `EmitterTrait`, and `EmitterInterface`.
* When rejecting Promises, it's now _required_ to use an `Exception` or
  `Throwable`. This makes the typical case simpler and reduces special cases.

3.0.0 (2015-11-05)
------------------

* Now requires PHP 5.5!
* `Promise::all()` is moved to `Promise\all()`.
* Aside from the `Promise\all()` function, there's now also `Promise\race()`.
* `Promise\reject()` and `Promise\resolve()` have also been added.
* Now 100% compatible with the Ecmascript 6 Promise.


3.0.0-alpha1 (2015-10-23)
-------------------------

* This package now requires PHP 5.5.
* #26: Added an event loop implementation. Also knows as the Reactor Pattern.
* Renamed `Promise::error` to `Promise::otherwise` to be consistent with
  ReactPHP and Guzzle. The `error` method is kept for BC but will be removed
  in a future version.
* #27: Support for Promise-based coroutines via the `Sabre\Event\coroutine`
  function.
* BC Break: Promises now use the EventLoop to run "then"-events in a separate
  execution context. In practise that means you need to run the event loop to
  wait for any `then`/`otherwise` callbacks to trigger.
* Promises now have a `wait()` method. Allowing you to make a promise
  synchronous and simply wait for a result (or exception) to happen.


2.0.2 (2015-05-19)
------------------

* This release has no functional changes. It's just been brought up to date
  with the latest coding standards.


2.0.1 (2014-10-06)
------------------

* Fixed: `$priority` was ignored in `EventEmitter::once` method.
* Fixed: Breaking the event chain was not possible in `EventEmitter::once`.


2.0.0 (2014-06-21)
------------------

* Added: When calling emit, it's now possible to specify a callback that will be
  triggered after each method handled. This is dubbed the 'continueCallback' and
  can be used to implement strategy patterns.
* Added: Promise object!
* Changed: EventEmitter::listeners now returns just the callbacks for an event,
  and no longer returns the list by reference. The list is now automatically
  sorted by priority.
* Update: Speed improvements.
* Updated: It's now possible to remove all listeners for every event.
* Changed: Now uses psr-4 autoloading.


1.0.1 (2014-06-12)
------------------

* hhvm compatible!
* Fixed: Issue #4. Compatibility for PHP < 5.4.14.


1.0.0 (2013-07-19)
------------------

* Added: removeListener, removeAllListeners
* Added: once, to only listen to an event emitting once.
* Added README.md.


0.0.1-alpha (2013-06-29)
------------------------

* First version!
