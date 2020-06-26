<?php


class Robot
{

    private $x_axis = 0; //x-axis values ranging from 0 to 5 for 5X5 table top
    private $y_axis = 0; //y-axis values ranging from 0 to 5 for 5X5 table top
    private $face = null; // direction where robot is facing
    private $move = null; // left, right rotation

    private $permissible_axis_value = array('0', '1', '2', '4', '5');
    private $permissible_face_value = array('NORTH', 'SOUTH', 'EAST', 'WEST');
    private $permissible_move_direction_value = array('LEFT', 'RIGHT');

    private $err = 0;
    private $err_msg = array();

    /*Place robot in particular spot*/
    public function place($x_axis, $y_axis, $face)
    {
        $error_flag = 0; //value changes to 1 in case of error;

        //var_dump($this->permissible_axis_value);
        if (!in_array($x_axis, $this->permissible_axis_value)) {
            $this->err = 1;
            $this->err_msg[] = "Can't place wallie on table top of 5X5";
        }

        if (!in_array($y_axis, $this->permissible_axis_value)) {
            $this->err = 1;
            $this->err_msg[] = "Can't place wallie on table top of 5X5";
        }

        if (!in_array($face, $this->permissible_face_value)) {
            $this->err = 1;
            $this->err_msg[] = "Can't place wallie on table top of 5X5";
        }

        if($this->err == 0) {
            $this->x_axis = $x_axis;
            $this->y_axis = $y_axis;
            $this->face = $face;
        }
    }

    // reports current position of robot
    public function report(){
        if($this->err === 0) {
            $position = array();

            $position['x-axis'] = $this->x_axis;
            $position['y-axis'] = $this->y_axis;
            $position['face'] = $this->face;


            return $position;
        } else {
            $error = array();
            $error['error'] = $this->err_msg;
            unset($this->err);
            unset($this->err_msg);
            return $error;
        }
    }

    public function move(){

        $current_x = $this->x_axis;
        $current_y = $this->y_axis;
        $current_face = $this->face;
        //$error_msg = null;

        $new_x = 0; $new_y = 0;

        //check for the edges of table

        if($current_y == 0 && $current_face == 'SOUTH' ){
            $this->err = 1;
            $this->err_msg[] = "wallie wont move.. wallie will fall!!";
        }

        if($current_x == 0 && $current_face == 'WEST'){
            $this->err = 1;
            $this->err_msg[] = "wallie wont move.. wallie will fall!!";
        }

        if($current_y == 5 && $current_face == 'NORTH' ){
            $this->err = 1;
            $this->err_msg[] = "wallie wont move.. wallie will fall!!";
        }

        if($current_x == 5 && $current_face == 'EAST'){
            $this->err = 1;
            $this->err_msg[] = "wallie wont move.. wallie will fall!!";
        }

        //if not on edge facing outwards allow to move 1 step inwards
        if($this->err === 0){

            if($current_face == 'NORTH'){
                $new_x = $current_x;
                $new_y = $current_y + 1;
                //die($new_y);
            }

            if($current_face == 'SOUTH'){
                $new_x = $current_x;
                $new_y = $current_y - 1;
            }

            if($current_face == 'EAST'){
                $new_x = $current_x + 1;
                $new_y = $current_y;
            }

            if($current_face == 'WEST'){
                $new_x = $current_x - 1;
                $new_y = $current_y;
            }

            $this->x_axis = $new_x;
            $this->y_axis = $new_y;
        }

        //var_dump($error_msg);
    }

    //rotate robot 90 degrees left
    public function left(){
        $current_face = $this->face;
        $new_face = null;

        if($current_face == 'NORTH'){
            $new_face = 'WEST';
        }

        if($current_face == 'WEST'){
            $new_face = 'SOUTH';
        }

        if($current_face == 'SOUTH'){
            $new_face = 'EAST';
        }

        if($current_face == 'EAST'){
            $new_face = 'NORTH';
        }

        $this->face = $new_face;
    }

    //rotate robot 90 degrees right
    public function right(){
        $current_face = $this->face;
        $new_face = null;

        if($current_face == 'NORTH'){
            $new_face = 'EAST';
        }

        if($current_face == 'EAST'){
            $new_face = 'SOUTH';
        }

        if($current_face == 'SOUTH'){
            $new_face = 'WEST';
        }

        if($current_face == 'WEST'){
            $new_face = 'NORTH';
        }

        $this->face = $new_face;
    }
}
