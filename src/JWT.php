<?php namespace Publish;

use Illuminate\Cache\Repository;

class JWT
{
    private int $expiration;

    public function __construct(
        private string $privateKey,
        private string $applicationId,
        private Repository $cache
    ) {
        $this->expiration = 10 * 60;
    }

    public function createToken(): string
    {
        return $this->cache->remember(
            "nova-publish-jwt-token",
            $this->expiration,
            function (): string {
                $header = [
                    "alg" => "RS256",
                    "typ" => "JWT",
                ];

                $payload = [
                    "iat" => time() - 60,
                    "exp" => time() + $this->expiration,
                    "iss" => $this->applicationId,
                ];

                $header = json_encode($header);
                $payload = json_encode($payload);
                if ($header === false || $payload === false) {
                    throw new \Exception(
                        "Failed to encode JWT header or payload."
                    );
                }
                $header = $this->base64url_encode($header);
                $payload = $this->base64url_encode($payload);

                $privateKey = openssl_pkey_get_private($this->privateKey);
                if ($privateKey === false) {
                    throw Exception::invalidPrivateKey();
                }

                $data = "$header.$payload";
                $success = openssl_sign(
                    $data,
                    $signature,
                    $privateKey,
                    "sha256WithRSAEncryption"
                );
                if ($success === false) {
                    throw Exception::failedToSignData();
                }

                $signature = $this->base64url_encode($signature);

                return "$header.$payload.$signature";
            }
        );
    }

    private function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), "+/", "-_"), "=");
    }
}
