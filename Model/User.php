<?php

declare(strict_types=1);

namespace BuyMeACoffee\Model;

class User {
   private const MINIMUM_PASSWORD = 5;
   public function create(array $userDetails): bool {
      return true;
   }

   public function login(string $email, string $password): bool {
     return true;
   }
}