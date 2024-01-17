<?php
namespace App\Enums;

enum ServiceEnum: string
{
    case FLIGHTS = 'Flight Booking';
    case HOTELS = 'Hotel Booking';
    case CAR_RENTALS = 'Car Rentals';
    case AMTRAK = 'AMTRAK Booking';
}
