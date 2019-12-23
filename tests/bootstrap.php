<?php

require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';
require_once __DIR__.'/../vendor/autoload.php';

(new \Bunsen\Bunsen)->bootstrap(__DIR__ . '/ci_app/index.php');
