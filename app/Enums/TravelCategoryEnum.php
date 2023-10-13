<?php
namespace App\Enums;

enum TravelCategoryEnum: string
{
    case FLIGHTS = 'Flights';
    case HOTELS = 'Hotels';
    case PACKAGES = 'Packages';
    case CAR_RENTALS = 'Car Rentals';
    case AMTRAK = 'AmTrak';
}
