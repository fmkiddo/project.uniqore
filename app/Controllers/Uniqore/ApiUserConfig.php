<?php
namespace App\Controllers\Uniqore;


use App\Controllers\BaseUniqoreAPIController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserConfig extends BaseUniqoreAPIController {
    
    protected $modelName    = 'App\Models\Uniqore\ClientConfig';
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseUniqoreAPIController::doCreate()
     */
    protected function doCreate(array $json, $userid = 0): array|ResponseInterface {
        $dbPswd         = $json['clientdbpswd'];
        $storedPswd     = bin2hex ($this->encrypt ($dbPswd));
        $insertParams   = [
            'client_id'     => $json['clientid'],
            'db_name'       => $json['clientdbname'],
            'db_user'       => $json['clientdbuser'],
            'db_password'   => $storedPswd,
            'db_prefix'     => $json['clientdbprefix'],
            'created_by'    => $userid,
            'updated_at'    => date ('Y-m-d H:i:s'),
            'updated_by'    => $userid
        ];
        $this->model->insert ($insertParams);
        $insertID   = $this->model->getInsertID ();
        if (!$insertID)
            $retJSON    = [
                'status'    => 500,
                'error'     => 500,
                'messages'  => [
                    'error'     => 'Failed to register new API client or user'
                ]
            ];
        else {
            $payload    = [
                'returnid'  => $insertID,
            ];
            
            $retJSON    = [
                'status'    => 200,
                'error'     => NULL,
                'messages'  => [
                    'success'   => 'New API client or user successfully registered to system'
                ],
                'data'      => [
                    'uuid'      => time (),
                    'timestamp' => date ('Y-m-d H:i:s'),
                    'payload'   => bin2hex ($this->encrypt (serialize($payload)))
                ]
            ];
        }
        return $retJSON;
    }
    
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseUniqoreAPIController::doUpdate()
     */
    protected function doUpdate($id, array $json, $userid = 0): array|ResponseInterface {
    } 
    
    protected function responseFormatter($queryResult): array {
        
    }
    
    protected function findWithFilter($get) {
        
    }
    
}