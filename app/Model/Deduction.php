<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'amount',
        'month',
        'deduction_type',
        'date_of_deduction',
        'comment'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getTypes()
    {
        $connection = \Illuminate\Database\Capsule\Manager::connection();
        $raw = $connection->select("SHOW COLUMNS FROM deductions WHERE Field = 'deduction_type'");
        if (empty($raw)) {
            return [];
        }
        $enumStr = $raw[0]->Type;
        preg_match_all("/'([^']+)'/", $enumStr, $matches);
        return $matches[1];
    }
}