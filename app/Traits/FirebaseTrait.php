<?php

namespace App\Traits;

use Google\Cloud\Firestore\FirestoreClient;

trait FireBaseTrait
{
    protected $db;

    public function initialize()
    {
        $config = [
            'projectId'   => config('firestore.projectId'),
        ];
        // Create the Cloud Firestore client
        $this->db = new FirestoreClient($config);
    }

    public function addData($collection, $data)
    {
        $this->initialize();
        $addedDocRef = $this->db->collection($collection)->add($data);
        return $addedDocRef;
    }
}
