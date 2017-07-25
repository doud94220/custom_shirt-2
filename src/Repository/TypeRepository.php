<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 20/07/2017
 * Time: 13:50
 */

namespace Repository;

use Entity\Type;

class TypeRepository extends RepositoryAbstract
{

    public function getTable()
    {
        return 'type';
    }

    /**
     * @return array
     */
    public function findAllTypes()
    {
        $dbTypes = $this->db->fetchAll('SELECT * FROM type');
        $types = []; // le tableau dans lequel vont être stockées les entités Type

        foreach ($dbTypes as $dbType) {
            $type = $this->buildFromArray($dbType);

            $types[] = $type;
        }

        return $types;
    }

    /**
     * @param int $id
     * @return Category|null
     */
    public function find($id)
    {
        $dbType = $this->db->fetchAssoc(
            'SELECT * FROM type WHERE id = :id',
            [':id' => $id]
        );

        if (!empty($dbType)) {
            return $this->buildFromArray($dbType);
        }

        return null;
    }

//    public function save(Category $category)
//    {
//        $data = ['name' => $category->getName()];
//
//        $where = !empty($category->getId())
//            ? ['id' => $category->getId()] // modification
//            : null // création
//        ;
//
//        $this->persist($data, $where);
//    }
//
//    public function delete(Category $category)
//    {
//        $this->db->delete('category', ['id' => $category->getId()]);
//    }

    /**
     * @param array $dbCategory
     * @return Category
     */
    public function buildFromArray(array $dbType)
    {
        $type = new Type();

        $type
            ->setId($dbType['id'])
            ->setType($dbType['type'])
        ;

        return $type;
    }

}