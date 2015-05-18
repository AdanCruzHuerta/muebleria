<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = ['email','password','roles_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/*
	 * funcion para relacionar User_Rol
	 */ 
	public function rol()
	{

		return $this->belongsTo('Rol');

	}
	/*
	 * funcion para relacionar User_Persona
	 */ 
	public function persona()
	{

		return $this->belongsTo('Persona');

	}

}
