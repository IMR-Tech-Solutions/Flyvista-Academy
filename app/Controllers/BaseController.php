<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;

abstract class BaseController extends Controller
{
    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Global data accessible in all views
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
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Load your model
        $this->flyvistaModel = new \App\Models\FlyvistaModel();

        // Load dynamic course list for menu
        $this->data['courses_menu'] = $this->flyvistaModel->getTableData(
            'courses',
            ['status' => 1],
            'id',
            0
        );

        // ---------------------------------------------
        // Load contact info (FIRST ROW from contact_info)
        // ---------------------------------------------
        $contactData = $this->flyvistaModel->getTableData('contact_info');

        // Get first row (object)
        $contact = !empty($contactData) ? $contactData[0] : null;

        // Always provide safe empty values if no DB row exists
        $this->data['contact'] = $contact ?? (object) [
            'phone'     => '',
            'email'     => '',
            'facebook'  => '',
            'twitter'   => '',
            'instagram' => '',
            'linkedin'  => '',
            'whatsapp'  => ''
        ];
    }
}
