<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    // hapus bawah allowed field created_at jika pake datetime otomatis
    protected $allowedFields    = ['title', 'body', 'image', 'user_id', 'category_id', 'created_at'];

    // Dates
    protected $useTimestamps = true;
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

    public function search($keyword)
    {
        return $this->table('posts')->like('title', $keyword)->orLike('body', $keyword);
    }
    // for user
    public function getAllFadmin()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('posts');
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , image , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        $query = $builder->orderBy('posts.created_at', 'DESC')->get();
        return  $query->getResult();
    }
    public function getAll()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('posts');
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , image , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        $query = $builder->where('user_id', session()->get('id'))->orderBy('posts.created_at', 'DESC')->get();
        return  $query->getResult();
    }
    public function getPostById($postId)
    {
        // $db      = \Config\Database::connect();
        $builder = $this->builder();
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , posts.image as postImg , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        $query = $builder->where('posts.id', $postId)->get();
        return  $query->getResult();
    }

    public function getById($category_id)
    {
        // $db      = \Config\Database::connect();
        $builder = $this->builder();
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , image , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        $query = $builder->where('category_id', $category_id)->orderBy('posts.created_at', 'DESC')->get();
        return  $query->getResult();
    }
    public function homePaginate($num)
    {

        $builder = $this->builder();
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , image , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        return  [
            'posts' =>  $this->orderBy('posts.created_at', 'DESC')->paginate($num),
            $this->pager
        ];
        // return $data;
    }
    public function myPaginated($num)
    {
        $builder = $this->builder();
        $builder->select('posts.id as postId, category_id, user_id, categories.name as name_category , users.name as name_user ,title , body , image , posts.created_at as ct');
        $builder->join('categories', 'categories.id = posts.category_id');
        $builder->join('users', 'users.id = posts.user_id');
        // $data = [
        // ];
        return [
            'posts' => $this->where('user_id', session()->get('id'))->orderBy('posts.created_at', 'DESC')->paginate($num, 'posts'),
            $this->pager

        ];
    }
}
