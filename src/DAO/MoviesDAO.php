<?php

namespace App\src\DAO;

class MoviesDAO
{
	public function getFilm()
	{
		$directory = '../video/film';
		$scanFilm = array_diff(scandir($directory), array('..', '.'));

		return $scanFilm;
	}

	public function getHeroCorp()
	{
		$directory = '../video/herocorp';
		$scanHerocorp = array_diff(scandir($directory), array('..', '.'));

		return $scanHerocorp;
	}

	public function getDoc()
	{
		$directory = '../video/doc';
		$scanDoc = array_diff(scandir($directory), array('..', '.'));

		return $scanDoc;
	}
	public function getSimpson()
	{
		$directory = '../video/simpson';
		$scanSimpson = array_diff(scandir($directory), array('..', '.'));

		return $scanSimpson;
	}
}