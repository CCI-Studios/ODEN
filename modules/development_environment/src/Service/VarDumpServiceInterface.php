<?php

/**
 * @file Contains Drupal\development_environment\Service\VarDumpServiceInterface
 *
 * Provides a method to dump output to the watchdog, in a human-readable manner
 */

namespace Drupal\development_environment\Service;

interface VarDumpServiceInterface
{
	public function varDump($var, $return = false, $html = false, $level = 0);
}
