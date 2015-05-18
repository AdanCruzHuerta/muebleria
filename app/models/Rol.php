<?php

class Rol extends \Eloquent {
	protected $fillable = ['tipo'];

	/*
	 * funcion para relacionar Rol_User
	 */ 
	public function user()
	{
		return $this->hasMany('User');
	}
}