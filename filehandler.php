<?php

# GET request URL parts from isnotes.php
$filename = $_GET['name'];
$extension = $_GET['ext'];
$shortfilename = $_GET['shortname'];

# build internalizer header for browser link
if ($extension == "pdf") {
    header("Content-type: application/pdf"); 
}
if ($extension == "xls") {
    header("Content-type: application/msexcel"); 
}
if ($extension == "xlsx") {
    header("Content-type: application/msexcel"); 
}
if ($extension == "doc") {
    header("Content-type: application/msword"); 
}
if ($extension == "docx") {
    header("Content-type: application/msword"); 
}
if ($extension == "rtf") {
    header("Content-type: application/msword"); 
}
if ($extension == "txt") {
    header("Content-type: application/text"); 
}
if ($extension == "zip") {
    header("Content-type: application/zip"); 
}
if ($extension == "jpg") {
    header("Content-type: application/jpg"); 
}
if ($extension == "png") {
    header("Content-type: application/png"); 
}
if ($extension == "bmp") {
    header("Content-type: application/bmp"); 
}

header("Content-Disposition: inline; filename='$shortfilename'"); 

$file = readfile($filename);
echo $file;
