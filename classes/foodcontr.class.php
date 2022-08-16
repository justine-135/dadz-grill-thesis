<?php

class FoodContr extends Foods
{
    private $name;
    private $group;
    private $cost;
    private $stats;
    private $fileActualExt;
    private $fileTempLoc;
    private $target;
    private $fileError;
    private $fileNameTime;
    private $allowed;
    private $img;

    public function __construct($name, $group, $cost, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img)
    {
        $this->name = $name;
        $this->group = $group;
        $this->cost = $cost;
        $this->stats = $stats;
        $this->fileActualExt = $fileActualExt;
        $this->fileTempLoc = $fileTempLoc;
        $this->target = $target;
        $this->fileError = $fileError;
        $this->fileNameTime = $fileNameTime;
        $this->allowed = $allowed;
        $this->fid = $fid;
        $this->img = $img;
    }

    public function initSetFood()
    {
        $this->setFood($this->name, $this->group, $this->cost, $this->stats, $this->fileActualExt, $this->fileTempLoc, $this->target, $this->fileError, $this->fileNameTime, $this->allowed);
        header("location: ../foods.php?alert=store&id=0");
    }

    public function initUpdateFood()
    {
        $this->updateFood($this->name, $this->group, $this->cost, $this->stats, $this->fid);
        header("location: ../foods.php?alert=update&id=" . $this->fid);
    }

    public function initDeleteFood()
    {
        $this->deleteFood($this->img, $this->fid);
        header("location: ../foods.php?alert=delete&id=" . $this->fid);
    }
}
