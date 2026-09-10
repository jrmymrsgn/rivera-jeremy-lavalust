<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AccountModel extends Model {
    protected $table = 'accounts';
    protected $primary_key = 'id';
    protected $guarded = ['id'];
}