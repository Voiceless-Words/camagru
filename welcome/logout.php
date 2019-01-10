<?php
session_start();
unset($_SESSION["emailL"]);
session_destroy();
header("Location: ../");
exit();