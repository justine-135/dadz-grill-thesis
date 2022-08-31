<?php

class AdminContr extends Admin
{
    public function initDelete($id)
    {
        $this->deleteAdmin($id);
    }
}
