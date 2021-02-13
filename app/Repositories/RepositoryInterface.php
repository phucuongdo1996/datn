<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * PHP version 7.2
 *
 * @category  Repositories
 * @package   App\Repositories
 * @author    Pham Trung Thuan <thuanpt@deha-soft.com>
 * @copyright 2019 CYARea!
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://laravel.com Laravel(tm) Project
 */

namespace App\Repositories;

/**
 * Repository Interface
 *
 * @category  Repositories
 * @package   App\Repositorys
 * @author    Pham Trung Thuan <thuanpt@deha-soft.com>
 * @copyright 2019 CYARea!
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://laravel.com Laravel(tm) Project
 */
interface RepositoryInterface
{
    /**
     * Get all data
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get one data
     *
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Create data
     *
     * @param array $attributes Attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update data
     *
     * @param integer $id         ID
     * @param array   $attributes Attributes
     *
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Get count
     *
     * @return mixed
     */
    public function count();

    /**
     * Save data
     *
     * @param array $data Recode
     *
     * @return mixed
     */
    public function store(array $data);

    /**
     * Create multiple
     *
     * @param array $data Recode data
     *
     * @return mixed
     */
    public function createMultiple(array $data);

    /**
     * Delete by id
     *
     * @param integer $id Identity of table
     *
     * @return mixed
     */
    public function deleteById($id);

    /**
     * Delete multiple by id
     *
     * @param array $ids Id
     *
     * @return mixed
     */
    public function deleteMultipleById(array $ids);

    /**
     * Get first column
     *
     * @param array $columns column name
     *
     * @return mixed
     */
    public function first(array $columns = ['*']);

    /**
     * Get all data
     *
     * @param array $columns column name
     *
     * @return mixed
     */
    public function get(array $columns = ['*']);

    /**
     * Get recode by id
     *
     * @param integer $id      id
     * @param array   $columns column
     *
     * @return mixed
     */
    public function getById($id, array $columns = ['*']);

    /**
     * Get one data or throw exception
     *
     * @param integer|array $id ID
     *
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Add a simple where clause to the query.
     *
     * @param string $column   column
     * @param string $value    value for column
     * @param string $operator operator
     *
     * @return mixed
     */
    public function where($column, $value, $operator = '=');
}
