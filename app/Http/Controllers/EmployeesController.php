<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;

class EmployeesController extends Controller
{
   
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);

        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    
    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output) {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('default_template', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files
        ]);
    }
    


    /**
     * Show the datagrid for customers
     *
     * @return \Illuminate\Http\Response
     */
    public function datagrid()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('employees');
        $crud->displayAs('officeCode','Office City');

        $crud->setSubject('Employee');
        $crud->setFieldUpload('file_url','assets/uploads/files','assets/uploads/files');
        //many to one relation
        $crud->setRelation('officeCode','offices','city');



        $output = $crud->render();
        return $this->_show_output($output);

    }
}
