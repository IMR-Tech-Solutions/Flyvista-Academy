<?php

namespace App\Models;

use CodeIgniter\Model;

class FlyvistaModel extends Model
{
    // Get all data
    public function getTableData($table, $where = [], $orderBy = '', $limit = null)
    {
        $builder = $this->db->table($table);

        if (!empty($where)) {
            $builder->where($where);
        }

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        if (!empty($limit)) {
            $builder->limit($limit);
        }

        return $builder->get()->getResult();
    }

    // Insert data
    public function insertData($table, $data)
    {
        return $this->db->table($table)->insert($data);
    }

    // Get single row by id
    public function getRowById(string $table, int $id)
    {
        return $this->db->table($table)->where('id', $id)->get()->getRowArray();
    }

    // Delete by id
    public function deleteRowById(string $table, int $id): bool
    {
        return $this->db->table($table)->where('id', $id)->delete();
    }

    // Update by id
    public function updateRowById(string $table, int $id, array $data): bool
    {
        return $this->db->table($table)->where('id', $id)->update($data);
    }
}