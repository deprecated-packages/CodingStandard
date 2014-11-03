<?php


class Answer
{

	/**
	 * @param bool
	 */
	private $isCorrect = FALSE;

	/**
	 * @ORM\Column(type="boolean")
	 * @var bool
	 */
	private $status = TRUE;


	/**
	 * @param bool $strict Check if boolean value has changed.
	 * @return bool
	 */
	public function hasChanged($strict = FALSE)
	{
		/** @var bool $hasChecked */
		$hasChecked = '...';
	}

}
