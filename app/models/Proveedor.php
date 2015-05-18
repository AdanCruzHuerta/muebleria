<?php

class Proveedor extends \Eloquent {

	protected $table = 'proveedores';

	protected $fillable = ['nombre','domicilio','responsable','ciudad'];
}