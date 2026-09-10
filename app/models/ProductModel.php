<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model {
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $guarded = ['id'];
    protected $timestamps = false; // created_at already has a DB default
}