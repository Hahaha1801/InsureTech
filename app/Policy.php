<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
        'c_name', 'customer_id', 'address', 'mobile_no', 'refered_by', 'group', 'insurer_name', 'p_type', 'p_name', 'p_number', 'start_date', 'end_date', 'sub_ins', 'premium', 'tp_motor', 'basic', 'terr', 'eq', 'other', 'stfi', 'gst', 'receipt_date', 'total', 'remark', '_token'
    ];
}
