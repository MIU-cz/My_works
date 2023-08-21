<?php
class Component
{
	public function constructContent()
	{
		return $content;
	}

	public function render()
	{
		return $this->constructContent();
	}
}
