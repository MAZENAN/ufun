<?php

function smarty_modifier_sprint($number) {
    return sprintf("%.2f", $number);
}

