<?php

class Model
{
    /**
     * @return array
     * @throws Exception
     */
    public static function getDataFromGithub()
    {
        $ch = curl_init('https://api.github.com/users');
        $headers = [
            'Content-Type: text/json',
            'User-Agent: Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if (!$data) {
            throw new \Exception('Wrong data');
        }
        if (!count($data)) {
            throw new \Exception('Empty data');
        }

        return $data;
    }

    /**
     * @param array $users
     */
    public static function addUsers(array $users)
    {
        $dbUsers = array_column(User::getAllUsers(), 'github_login', 'github_id');

        if (count($users)) {
            foreach ($users as $user) {
                if (isset($dbUsers[$user['id']])) {
                    User::updateUser($user);
                } else {
                    User::addUser($user);
                }
            }
        }
    }



}