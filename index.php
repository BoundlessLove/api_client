<?php 
namespace api_client;
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//phpinfo(); 

/*
 * index.php
 * 
 * Copyright 2025 Administrator <administrator@internal.systematicdefence.tech@nzj-dev-ubuntu22>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

//hosted on http://localhost:8080
echo "<h1>Hello from Api-Client</h1>";

//$apiUrl = 'http://localhost:8080/api/data';
$apiUrl = 'http://localhost:88';
$config = require __DIR__ . '/config.php';
$apiKey = $config['validApiKey'];

$headers = [
	'x-api-key: ' . $apiKey,
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if($httpCode ===200){
	echo "Response: " . $response;
}else{
	echo "Error: HTTP $httpCode";
}
