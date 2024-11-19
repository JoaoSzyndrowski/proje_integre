<?php
session_start();

if(isset($_SESSION)){
    session_destroy();
}
if(session_destroy()){
    echo "sessoa destroua";
}


?>