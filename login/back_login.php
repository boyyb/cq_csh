<?php
header("content-type:text/html;charset=utf-8");
session_start();
unset($_SESSION['username']);
session_destroy();
header("location:/1_csh/login");

