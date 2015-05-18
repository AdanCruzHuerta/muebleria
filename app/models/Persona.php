<?php

class Persona extends \Eloquent {

	protected $table = 'personas';
	
	protected $fillable = ['nombre','apellido_p','apellido_m','ciudad','calle','numero_ext','numero_int','telefono','rfc','codigo_postal','actualizo_datos','users_id','municipios_id'];
	
	/*
	 * funcion para relacionar Persona_User
	 */ 
	public function user()
	{
		return $this->belongsTo('User');
	}
}