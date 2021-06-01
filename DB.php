<?php

class DB
{
    public $connection;

    public function __construct()
    {
        $host = config("db.host");
        $db = config("db.database");
        $user = config("db.user");
        $password = config("db.password");
        $dsn = "mysql:host=$host;dbname=$db";
        $this->connection = new PDO($dsn, $user, $password);
    }

    private function checkExistingVisit($ip, $url, $user_agent)
    {
        $existingRecordStmt = $this->connection->prepare("SELECT id FROM visits WHERE ip_address=:ip_address AND page_url = :url AND user_agent = :user_agent");
        $existingRecordStmt->execute(['ip_address' => $ip, 'url' => $url, 'user_agent' => $user_agent]);
        return $existingRecordStmt->fetch();
    }

    private function incrementExistingVisit($id)
    {
        $updateStatement = $this->connection->prepare ("UPDATE visits SET views_count = views_count + 1 WHERE id = :id");
        $updateStatement->execute(['id' => $id]);
    }

    private function insertVisit($data)
    {
        $insertStatement = $this
            ->connection
            ->prepare ("INSERT INTO visits (ip_address, user_agent, view_date, page_url, views_count) 
                                            VALUES (:ip_address, :user_agent, :view_date, :page_url, 1)");
        $insertStatement->execute($data);
    }

    public function updateOrCreate($data)
    {
        $exists = $this->checkExistingVisit($data['ip_address'], $data['page_url'], $data['user_agent']);
        if (!$exists)
        {
            $this->insertVisit($data);
        }
        else
        {
            $this->incrementExistingVisit($exists['id']);
        }
    }
}
