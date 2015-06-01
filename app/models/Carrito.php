<?php

class Carrito extends \Eloquent {

	protected $table = 'personas_has_articulos';

	protected $fillable = ['personas_id','articulos_id','importe'];
}