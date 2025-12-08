<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\FlyvistaModel;
use Psr\Log\LoggerInterface;

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
     * Global data shared across all views
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Flyvista Model
     */
    protected $flyvistaModel;


    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        /*
        |--------------------------------------------------------------------------
        | Load Main Model
        |--------------------------------------------------------------------------
        */
        $this->flyvistaModel = new FlyvistaModel();

        /*
        |--------------------------------------------------------------------------
        | Load Dynamic Courses for Header Dropdown
        |--------------------------------------------------------------------------
        */
        $courses = $this->flyvistaModel->getTableData(
            'courses',
            ['status' => 1],
            'id',
            0
        );

        $this->data['courses_menu'] = $courses;

        /*
        |--------------------------------------------------------------------------
        | Load Contact Info for Topbar
        |--------------------------------------------------------------------------
        | Table: contact_info
        | Query runs from FlyvistaModel::getTableData()
        */
        $contact = $this->flyvistaModel->getTableData(
            'contact_info',
            [],      // no condition → fetch first() row
            'id',
            1        // return single row
        );

        $this->data['contact'] = $contact;

        /*
        |--------------------------------------------------------------------------
        | Share Data Globally With All Views
        |--------------------------------------------------------------------------
        */
        $renderer = \Config\Services::renderer();
        $renderer->setVar('courses_menu', $courses);
        $renderer->setVar('contact', $contact);
    }
}
