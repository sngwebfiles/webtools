<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicationsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tblpublications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['id',
            'pub_id',
            'parent_pub_id',
            'group_content_pub_id',
            'name',
            'wordpress_url',
            'published',
            'wp_rest_api_endpoint_link',
            'wp_rest_api_user',
            'wp_rest_api_pass',
            'created_at',
            'updated_at'
        ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];





}
