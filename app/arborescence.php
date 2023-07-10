<?php

class arborescence
{
    public $repertoire;

    function __construct($dir)
    {
        $this->repertoire = $dir;
    }
    function charge()
    {
        $fileDirectory = $this->repertoire;
        $fileList = scandir($fileDirectory, SCANDIR_SORT_DESCENDING);
        $fileList = array_diff($fileList, array('.', '..'));
        return $fileList;
    }

}