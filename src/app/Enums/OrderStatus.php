<?php

namespace App\Enums;


enum OrderStatus: string
{
    case Pending = 'Pending';
    case Received = 'Received';
    case Preparing = 'Preparing';
    case Ready = 'Ready';
    case Completed = 'Completed';
}
