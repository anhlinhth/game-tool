<?php
require ROOT_APPLICATION_FORMS.DS.'Forms_Base.php';
require_once ROOT_APPLICATION_OBJECT.DS.'Obj_CompensationPlayer.php';

class Forms_CompensationPlayer extends Forms_Base
{
    public function __construct()
    {
        $this->obj = new Obj_CompensationPlayer();
    }
}
?>
