<?php

namespace MongoDB\Tests;

use InvalidArgumentException;
use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\WriteConcern;
use MongoDB\Model\BSONArray;
use MongoDB\Model\BSONDocument;
use MongoDB\Tests\Compat\PolyfillAssertTrait;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use stdClass;
use Traversable;
use function array_map;
use function array_merge;
use function array_values;
use function call_user_func;
use function getenv;
use function hash;
use function is_array;
use function is_object;
use function iterator_to_array;
use function MongoDB\BSON\fromPHP;
use function MongoDB\BSON\toJSON;
use function restore_error_handler;
use function set_error_handler;
use function sprintf;
use const E_US…
