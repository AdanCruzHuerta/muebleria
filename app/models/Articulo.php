<?php

class Articulo extends \Eloquent {

	protected $table = 'articulos';
	
	protected $fillable = ['nombre','precio','alto','largo','ancho','descrpcion','ruta_corta','ruta_absoluta'];

}