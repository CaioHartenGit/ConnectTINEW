<?php
session_start();
session_destroy();
header("Location: /ConnectTI/templates/index.php");
