<?php
/**
 * Created by PhpStorm.
 * User: Kavindu
 * Date: 10/12/2017
 * Time: 9:20 AM
 */
session_start();
session_destroy();
header('Location:index.html');