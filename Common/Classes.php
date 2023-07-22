<?php
class Rating {
    public int $minRating = 1;
    public int $maxRating = 5;
    public int $currentRating = 1;
    
}
class Cost  {
    public int $minCost = 1;
    public int $maxCost = 5;
    public int $currentCost = 1;
    
}
class Address {
    public string $street = "";
    public string $city = "";
    public string $provstate = "";
    public string $postalzipcode = "";
  
}

class Restaurant{
    public int $id;
    public string $name = "";
    public Address $address;
    public string $foodType = "";
    public string $summary = "";
    public Cost $cost;
    public Rating $rating;
    public function __construct() 
    {
        $this->address = new Address;
        $this->cost = new Cost;
        $this->rating = new Rating;  
    }
} 


