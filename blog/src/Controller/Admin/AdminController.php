<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Controller\Controller;

/**
 * AdminController Controller
 *
 * @method \App\Model\Entity\AdminController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
    }
}
