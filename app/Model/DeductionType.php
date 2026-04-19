<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionType extends Model
{
    use HasFactory;
    protected $table = 'deductiontypes';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }
}