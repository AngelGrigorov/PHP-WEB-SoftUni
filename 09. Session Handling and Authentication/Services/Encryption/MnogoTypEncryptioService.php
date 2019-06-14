<?php
/**
 * Created by IntelliJ IDEA.
 * User: RoYaL
 * Date: 10.6.2019 г.
 * Time: 20:36
 */

namespace Services\Encryption;


class MnogoTypEncryptioService implements EncryptionServiceInterface
{

    public function hash(string $password): string
    {
       $newPassword = '';
       for ($i = 0; $i < mb_strlen($password); $i++) {
           $newPassword .= chr(ord($password[$i]) + 2);
       }

       return $newPassword;
    }

    public function verify(string $password, string $hash): bool
    {
        for ($i = 0; $i < mb_strlen($hash); $i++) {
            if ($password[$i] != chr(ord($hash[$i]) - 2)) {
                return false;
            }
        }

        return true;
    }
}