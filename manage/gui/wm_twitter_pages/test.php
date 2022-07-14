<?php
require_once('twitter.php');

$consumer_key = 'AHY4eOq7keiYnPBmzPKa0lZYy';
$consumer_secret = 'pMA6UTt2pwSa41aF76rdC4PHVnThNImCiqPHE9g4b2rSEiUwj6';
$token = '3233487096-aDxN5Mxy2cQNLV7uy2CHO7xrhbE1riz1bNIRzk3';
$secret= '5gWlu9jNR8c5ICAN4QygNYld3gsBQvkfqrJ0PFkPj39ke';

$t = new twitter($consumer_key, $consumer_secret, $token, $secret);
$t->postTweet("Dohes Media!");

?>