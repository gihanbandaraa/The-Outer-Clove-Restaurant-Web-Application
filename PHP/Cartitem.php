<?php


class CartItem
{
   public $Title;
   public $ID;
   public $Description;
   public $Image;
   public $Price;
   public $Qty;

   public function getValue()
   {
     
      $price = floatval($this->Price);
      $qty = floatval($this->Qty);

      
      if (is_numeric($price) && is_numeric($qty)) {
         return $price * $qty;
      } else {
         return 0; 
      }
   }
}
