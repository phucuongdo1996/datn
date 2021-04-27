<?php

namespace App\Api\BaoKim;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class BaoKimApi
{
    /* Bao Kim API key */
    const API_KEY = "a18ff78e7a9e44f38de372e093d87ca1";
    const API_SECRET = "9623ac03057e433f95d86cf4f3bef5cc";
    const TOKEN_EXPIRE = 600; //token expire time in seconds
    const ENCODE_ALG = 'HS256';

    private static $_jwt = null;

    /**
     * Refresh JWT
     */
    public static function refreshToken()
    {

        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt;
        $expire     = $notBefore + self::TOKEN_EXPIRE;

        /*
         * Payload data of the token
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => self::API_KEY,     // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'form_params' => [                  // request body (dữ liệu post)
                //'a' => 'value a',
                //'b' => 'value b',
            ]
        ];

        /*
         * Encode the array to a JWT string.
         * Second parameter is the key to encode the token.
         *
         * The output string can be validated at http://jwt.io/
         */
        self::$_jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            self::API_SECRET, // The signing key
            'HS256'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        return self::$_jwt;
    }

    /**
     * Get JWT
     */
    public static function getToken()
    {
        if (!self::$_jwt) {
            self::refreshToken();
        }

        try {
            JWT::decode(self::$_jwt, self::API_SECRET, array('HS256'));
        } catch (Exception $e) {
            self::refreshToken();
        }

        return self::$_jwt;
    }

    /**
     * Tạo link url thanh toán.
     *
     * @param $data
     * @return mixed
     */
    public static function getUrlRedirect($data)
    {
        $user = Auth::user();
        $client = new Client(['timeout' => 20.0]);
        $options['query']['jwt'] = BaoKimApi::getToken();
        $payload['mrc_order_id'] = $user->user_code . time();
        $payload['total_amount'] = $data['total_amount'];
        $payload['description'] = "Nạp tiền qua Bao Kim";
        $payload['url_success'] = route(USER_RECHARGE_MONEY);
        $options['form_params'] = $payload;
        $response = $client->request("POST", "https://sandbox.baokim.vn/payment/api/v4/order/send", $options);
        $responseJson = json_decode($response->getBody()->getContents());
        return $responseJson->data->payment_url;
    }
}
