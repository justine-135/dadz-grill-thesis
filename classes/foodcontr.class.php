<?php

class FoodContr extends Foods
{
    private $name;
    private $group;
    private $cost;
    private $grams;
    private $servings;
    private $stats;
    private $fileActualExt;
    private $fileTempLoc;
    private $target;
    private $fileError;
    private $fileNameTime;
    private $allowed;
    private $img;
    private $inclusions;
    private $serving;
    private $inclusions_name;

    public function __construct($name, $group, $cost, $grams, $servings, $stats, $fileActualExt, $fileTempLoc, $target, $fileError, $fileNameTime, $allowed, $fid, $img, $inclusions, $serving, $inclusions_name)
    {
        $this->name = $name;
        $this->group = $group;
        $this->cost = $cost;
        $this->grams = $grams;
        $this->servings = $servings;
        $this->stats = $stats;
        $this->fileActualExt = $fileActualExt;
        $this->fileTempLoc = $fileTempLoc;
        $this->target = $target;
        $this->fileError = $fileError;
        $this->fileNameTime = $fileNameTime;
        $this->allowed = $allowed;
        $this->fid = $fid;
        $this->img = $img;
        $this->inclusions = $inclusions;
        $this->serving = $serving;
        $this->inclusions_name = $inclusions_name;
    }

    public function initSetFood()
    {
        $this->setFood($this->name, $this->group, $this->cost, $this->grams, $this->servings, $this->stats, $this->fileActualExt, $this->fileTempLoc, $this->target, $this->fileError, $this->fileNameTime, $this->allowed, $this->inclusions, $this->serving, $this->inclusions_name);
        header("location: ../foods.php?alert=store&id=0");
    }

    public function initUpdateFood()
    {
        $this->updateFood($this->name, $this->group, $this->cost, $this->grams, $this->servings, $this->stats, $this->fid);
        header("location: ../foods.php?alert=update&id=" . $this->fid);
    }

    public function initDeleteFood()
    {
        $this->deleteFood($this->img, $this->fid);
        header("location: ../foods.php?alert=delete&id=" . $this->fid);
    }
}
