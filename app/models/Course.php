<?php

class Course extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course';
        
    public $timestamps = false;
    
    public function students()
    {
        return $this->hasMany('Students');
    }
    

}
