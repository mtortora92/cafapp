<?php
function ticketStateBackgroundColor($stato){
    if($stato == 3){
        return "green";
    } else if ($stato == 2){
        return "orange";
    } else if ($stato == 1){
        return "red";
    }
}

function ticketStateTextColor($stato){
    if($stato == 3){
        return "text-success";
    } else if ($stato == 2){
        return "text-warning";
    } else if ($stato == 1){
        return "text-danger";
    }
}