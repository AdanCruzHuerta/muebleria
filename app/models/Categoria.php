<?php

class Categoria extends \Eloquent {

    use SoftDeletingTrait;

	protected $table = "categorias";

	protected $fillable = ['nombre','nivel_actual','slug'];

    protected $dates = ['deleted_at'];
}