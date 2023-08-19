<?php

class Scrypt
{
    private $array;
    private $encrypted = "";
    private $decrypted = "";

    private function enc_algorithm($password)
    {
        for ($i = 0; $i < strlen($password); $i++) {
            $letter = $password[$i];
            $number = $this->array["$letter"];
            $k = ($number + 7) % 74;
            $key = array_search("$k", $this->array);
            $this->encrypted .= $key;
        }
        return $this->generateRandomString() . $this->encrypted .  $this->generateRandomString();
    }

    private function dec_algorithm($password)
    {
        $password = substr($password, 5, -5);
        for ($i = 0; $i < strlen($password); $i++) {
            $letter = $password[$i];

            $number = $this->array["$letter"];

            $k = ($number - 7) % 74;

            $key = array_search("$k", $this->array);

            $this->decrypted .= $key;
        }

        return $this->decrypted;
    }

    public function encrypt($password)
    {

        $this->toNum();

        if ($password == "" || $password == null) {
            return 'Password can\'t be empty';
        }

        if (str_contains($password, ' ')) {
            return 'Password can\'t contain spaces';
        }

        return $this->enc_algorithm($password);
    }

    public function decrypt($password)
    {

        $this->toNum();

        if ($password == "" || $password == null) {
            return 'Password can\'t be empty';
        }

        if (str_contains($password, ' ')) {
            return 'Password can\'t contain spaces';
        }

        return $this->dec_algorithm($password);
    }

    private function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function toNum()
    {
        $this->array = [
            'a' => '01',
            'b' => '02',
            'c' => '03',
            'd' => '04',
            'e' => '05',
            'f' => '06',
            'g' => '07',
            'h' => '08',
            'i' => '09',
            'j' => '10',
            'k' => '11',
            'l' => '12',
            'm' => '13',
            'n' => '14',
            'o' => '15',
            'p' => '16',
            'q' => '17',
            'r' => '18',
            's' => '19',
            't' => '20',
            'u' => '21',
            'v' => '22',
            'w' => '23',
            'x' => '24',
            'y' => '25',
            'z' => '26',
            '1' => '27',
            '2' => '28',
            '3' => '29',
            '4' => '30',
            '5' => '31',
            '6' => '32',
            '7' => '33',
            '8' => '34',
            '9' => '35',
            '0' => '36',
            '@' => '37',
            '!' => '38',
            '$' => '39',
            '&' => '40',
            '^' => '41',
            '*' => '42',
            '(' => '43',
            ')' => '44',
            '-' => '45',
            '_' => '46',
            '+' => '47',
            '=' => '48',
            'A' => '49',
            'B' => '50',
            'C' => '51',
            'D' => '52',
            'E' => '53',
            'F' => '54',
            'G' => '55',
            'H' => '56',
            'I' => '57',
            'J' => '58',
            'K' => '59',
            'L' => '60',
            'M' => '61',
            'N' => '62',
            'O' => '63',
            'P' => '64',
            'Q' => '65',
            'R' => '66',
            'S' => '67',
            'T' => '68',
            'U' => '69',
            'V' => '70',
            'W' => '71',
            'X' => '72',
            'Y' => '73',
            'Z' => '74',
        ];
    }
}
