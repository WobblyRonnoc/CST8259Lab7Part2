<?php
include_once "Classes.php";

function displayRestaurantDataOnPage($rest) 
{
    global $txtStreetAddress,$txtCity, $txtProvinceState, $txtPostalZipCode;
    global $txtSummary, $txtFoodType, $drpRating, $drpRatingMin, $drpRatingMax; 
    global $drpCost, $drpCostMin, $drpCostMax;
    global $txtRestName, $drpRestaurant;
    
    $txtRestName = $rest->name;
    $txtStreetAddress = $rest->address->street;
    $txtCity = $rest->address->city; 
    $txtProvinceState = $rest->address->provstate; 
    $txtPostalZipCode = $rest->address->postalzipcode;

    $txtSummary = $rest->summary;
    $txtFoodType = $rest->foodType;

    $drpRating = $rest->rating->currentRating;
    $drpRatingMax = $rest->rating->maxRating;
    $drpRatingMin = $rest->rating->minRating;
    
    $drpCost = $rest->cost->currentCost;
    $drpCostMax = $rest->cost->maxCost;
    $drpCostMin = $rest->cost->minCost;
}

function getRestaurantDatafromPage( )
{
    global $txtStreetAddress,$txtCity, $txtProvinceState, $txtPostalZipCode;
    global $txtSummary, $txtFoodType, $drpRating, $drpRatingMin, $drpRatingMax; 
    global $drpCost, $drpCostMin, $drpCostMax;
    global $txtRestName, $drpRestaurant;
    
    $rest = new Restaurant();
    $rest->id = intval($drpRestaurant);

    $rest->name = $txtRestName;
    $rest->address->street = $txtStreetAddress;
    $rest->address->city = $txtCity; 
    $rest->address->provstate = $txtProvinceState; 
    $rest->address->postalzipcode =  $txtPostalZipCode;

    $rest->summary = $txtSummary;
    $rest->foodType = $txtFoodType;
    
    $rest->cost->currentCost = $drpCost;

    $rest->rating->currentRating = $drpRating;

    return $rest;
}

