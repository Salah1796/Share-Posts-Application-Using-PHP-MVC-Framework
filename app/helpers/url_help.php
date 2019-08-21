<?php
//redirct function
 function redirect($url)
{
    header("location:".URLROOT."/".$url);
}