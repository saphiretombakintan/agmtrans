<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
  protected $table = 'faktur';
  protected $primaryKey = 'id_faktur';
  public $fillable = ['id_faktur','no_faktur','po_number','codeitem','qty_ctn','id_principal','need_by_date','code_destinasi'];
}
