<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * BaseController for FlyVista
 */
abstract class BaseController extends Controller
{
    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Global data accessible in all views
     * (MUST be declared for PHP 8.2)
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Flyvista Model
     */
    protected $flyvistaModel;


    public function initController(\CodeIgniter\HTTP\RequestInterface $request, 
                                   \CodeIgniter\HTTP\ResponseInterface $response, 
                                   \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load model
        $this->flyvistaModel = new \App\Models\FlyvistaModel();

        // Load dynamic courses for header dropdown (status = 1)
        $courses = $this->flyvistaModel->getTableData(
            'courses',
            ['status' => 1],
            'id',
            0
        );

        // Save globally
        $this->data['courses_menu'] = $courses;
    }
}