<?php

class Students extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student';

    public $timestamps = false;


    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function address(){

        return $this->hasOne('StudentAddresses' , 'id');

    }

}
