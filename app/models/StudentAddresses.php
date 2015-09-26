<?php

class StudentAddresses extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_address';
    
    
    public $timestamps = false;
    
    public function students(){
       return $this->hasMany('Students');
    }
}
