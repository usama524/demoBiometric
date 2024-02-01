<?php
// (A) RELYING PARTY - CHANGE TO YOUR OWN!
$rp = [
  "name" => "Code Boxx",
  "id" => "localhost"
];

// (B) DUMMY USER
$user = [
  "id" => "12345678",
  "name" => "jon@doe.com",
  "display" => "Jon Doe"
];
$saveto = "user.txt"; 

// (C) START SESSION & LOAD WEBAUTHN LIBRARY
session_start();
require "vendor/autoload.php";
$WebAuthn = new lbuchs\WebAuthn\WebAuthn($rp["name"], $rp["id"]);