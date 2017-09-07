<?php

function showMoney($number) {
    return "Rp " . number_format($number, 2, ".", ",");
}

?>