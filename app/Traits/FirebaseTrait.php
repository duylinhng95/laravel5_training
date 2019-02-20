<?php

namespace App\Traits;

use Google\Cloud\Firestore\FirestoreClient;

trait FireBaseTrait
{
    /** @var FirestoreClient $db */
    protected $db;

    /**
     * @throws \Google\Cloud\Core\Exception\GoogleException
     */
    public function initialize()
    {
        $config = [
            'projectId'   => config('firestore.projectId'),
        ];
        // Create the Cloud Firestore client
        $this->db = new FirestoreClient($config);
    }

    /**
     * @param $collection
     * @param $data
     * @return mixed
     * @throws \Google\Cloud\Core\Exception\GoogleException
     */
    public function addData($collection, $data)
    {
        $this->initialize();
        $addedDocRef = $this->db->collection($collection)->add($data);
        return $addedDocRef;
    }
}
