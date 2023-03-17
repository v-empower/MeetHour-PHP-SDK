<?php
namespace App\Types;
class LoginType {
    private $client_id;
    private $client_secret;
    private $grant_type;
    private $password;
    private $username;

    public function getClientId(): string {
        return $this->client_id;
    }

    public function setClientId(string $client_id): void {
        $this->client_id = $client_id;
    }

    public function getClientSecret(): string {
        return $this->client_secret;
    }

    public function setClientSecret(string $client_secret): void {
        $this->client_secret = $client_secret;
    }

    public function getGrantType(): ?string {
        return $this->grant_type;
    }

    public function setGrantType(?string $grant_type): void {
        $this->grant_type = $grant_type;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function toArray()
    {
         $arr = [];
        return $arr;
    }
    
}
/*
$login = new Login();
$login->setClientId('client_id_value');
$login->setClientSecret('client_secret_value');
$login->setGrantType('grant_type_value');
$login->setPassword('password_value');
$login->setUsername('username_value');

$body = $login->toArray();
*/