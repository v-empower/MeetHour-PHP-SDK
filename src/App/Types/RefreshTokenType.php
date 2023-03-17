<?php

class RefreshToken
{
    private $client_id;
    private $client_secret;
    private $grant_type;
    private $refresh_token;

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    public function getGrantType(): string
    {
        return $this->grant_type;
    }

    public function setGrantType(string $grant_type): void
    {
        $this->grant_type = $grant_type;
    }

    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }
    public function build()
    {
       
        return [
            "client_id" => $this->client_id,
            "client_secret" => $this->client_secret,
            "grant_type" => $this->grant_type,
            "refresh_token" => $this->refresh_token,
        ];
    }
}
