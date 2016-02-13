<?php

require('lib/common.php');

function main() {
    session_start();
    render('MainPage');
}

main();