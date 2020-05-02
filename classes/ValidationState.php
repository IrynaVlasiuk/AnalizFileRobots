<?php

Class ValidationState
{
    public $status;
    public $state;
    public $recommendations;

    public function _constructor($status, $state, $recommendations)
    {
        $this->status = $status;
        $this->state = $state;
        $this->recommendations = $recommendations;
    }
}
