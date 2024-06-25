<?php

require '../../vendor/autoload.php';
use MongoDB\BSON\ObjectID;


    function get_db()
    {
        $mongo = new MongoDB\Client(
            "mongodb://localhost:27017/wai",
            [
                'username' => 'wai_web',
                'password' => 'w@i_w3b',
            ]);

        $db = $mongo->wai;

        return $db;
    }

    function add_element($element, $where)
    {
        $db = get_db();
        $db->$where->insertOne($element);
    }

    function get_elements($where, $query, $opts)
    {
        $db = get_db();
        return $db->$where->find($query, $opts);
    }

    function count_elements($where, $query, $opts)
    {
        $db = get_db();
        return $db->$where->count($query, $opts);
    }

    function get_element_by_id($where, $id)
    {
        $query = [
            '_id' => new ObjectId($id)
        ];
        $db = get_db();
        return $db->$where->findOne($query);
    }

    function deleteusers()
    {
        $db = get_db();
        $db->users->deleteMany([]);
    }
    function deletephotos()
    {
        $db = get_db();
        $db->photos->deleteMany([]);
    }

?>