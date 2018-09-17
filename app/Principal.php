<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
  protected $table = 'principal';
 protected $primaryKey = 'id_principal';

 public function pembelian(){
    return $this->hasMany('App\Penerimaan', 'id_principal');
 }
}
