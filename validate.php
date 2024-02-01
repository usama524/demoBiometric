<?php
// (A) INIT & CHECK
require "init.php";
if (!file_exists($saveto)) { exit("User is not registered"); }
$saved = unserialize(file_get_contents("user.txt"));

switch ($_POST["phase"]) {
  // (B) VALIDATION PART 1 - GET ARGUMENTS
  case "a":
    $args = $WebAuthn->getGetArgs([$saved->credentialId], 30);
    $_SESSION["challenge"] = ($WebAuthn->getChallenge())->getBinaryString();
    echo json_encode($args);
    break;

  // (C) VALIDATION PART 2 - CHECKS & PROCESS
  case "b":
    $id = base64_decode($_POST["id"]);
    if ($saved->credentialId !== $id) { exit("Invalid credentials"); }
    try {
      $WebAuthn->processGet(
        base64_decode($_POST["client"]),
        base64_decode($_POST["auth"]),
        base64_decode($_POST["sig"]),
        $saved->credentialPublicKey,
        $_SESSION["challenge"]
      );
      echo "OK";
      // DO WHATEVER IS REQUIRED AFTER VALIDATION
    } catch (Exception $ex) { print_r($ex); exit; }
    break;
}