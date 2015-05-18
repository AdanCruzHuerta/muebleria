<?php

class Slider extends \Eloquent {
	
	protected $table = 'sliders';
	
	protected $fillable = ['nombre','status_slider','ruta_slider','ruta_corta'];

}