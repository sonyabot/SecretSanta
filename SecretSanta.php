<?php

require_once('vendor/autoload.php');

class SecretSanta
{
    private $client;
    private $filepath;
    public $rows;

    public function __construct($api_key, $filepath)
    {
        $this->client = $this->setClient($api_key);
        $this->filepath = $filepath;
    }

    public function run()
    {
        $this->setRows();
        $matches = $this->getRandomizedMatches();
        foreach ($this->rows as $name => $email) {
            $message = $this->getMessage($email, $name, $matches[$name]);
            $this->send($message);
        }
    }

    public function setRows()
    {
        $fh = fopen($this->filepath, "r");
        $rows = [];
        if ($fh) {
            while (!feof($fh)) {
                $row = fgetcsv($fh);
                if ($row) {
                    $rows[$row[0]] = $row[1];
                }
            }
            fclose($fh);
        }
        $this->rows = $rows;
    }

    public function getRandomizedMatches()
    {
        $names = array_keys($this->rows);
        $matches = [];
        shuffle($names);
        for ($i = 0, $iMax = count($names); $i < $iMax; $i++) {
            if ($i === count($names) -1) {
                $matches[$names[$i]] = $names[0];
            } else {
                $matches[$names[$i]] = $names[$i +1];
            }
        }
        return $matches;
    }

    public function setClient($api_key)
    {
        $mailchimp = new MailchimpTransactional\ApiClient();
        $mailchimp->setApiKey($api_key);
        return $mailchimp;
    }

    public function send($message)
    {
        $response = $this->client->messages->send(["message" => $message]);
        print_r($response);
    }

    public function getMessage($email, $name, $gift_recipient)
    {
        return [
            "text" => "Hello " . $name . ". You are secret santa for " . $gift_recipient,
            "from_email" => "sonya@mailchimp.com",
            "to"=> [
                ["email"=> $email]
            ]
        ];
    }
}