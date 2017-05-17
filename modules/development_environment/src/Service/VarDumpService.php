<?php

/**
 * @file Contains Drupal\development_environment\Service\VarDumpService
 *
 * Provides a method to dump output to the watchdog, in a human-readable manner
 */

namespace Drupal\development_environment\Service;

class VarDumpService implements VarDumpServiceInterface
{
	public function varDump($var, $return = false, $html = false, $level = 0)
	{
		$spaces = "";
		$space = $html ? "&nbsp;" : " ";
		$newline = $html ? "<br />" : "\n";
		for ($i = 1; $i <= 4; $i++)
		{
			$spaces .= $space;
		}

		$tabs = $spaces;
		for($i = 1; $i <= $level; $i++)
		{
			$tabs .= $spaces;
		}

		if(is_array($var))
		{
			$title = "Array";
		}
		elseif(is_object($var))
		{
			$title = get_class($var)." Object";
		}

		$output = $title . $newline . $newline;
		foreach($var as $key => $value)
		{
			if(is_array($value) || is_object($value))
			{
				$level++;
				$value = $this->varDump($value, true, $html, $level);
				$level--;
			}
			$output .= $tabs . "[" . $key . "] => " . $value . $newline;
		}

		if($return)
		{
			return $output;
		}
		else
		{
			echo $output;
		}
	}
}
