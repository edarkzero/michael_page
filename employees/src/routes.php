<?php
// Routes
//Tried to use controller but don't import the right classes

$app->get('/', function ($request, $response, $args) {
    $content = file_get_contents(__DIR__.'/../employees.json');
    $employees = json_decode($content);
    // Render index view
    return $this->renderer->render($response, 'index.phtml', ['employees' => $employees,'search' => '']);
})->setName('emp.index');

$app->any('/grid', function ($request, $response, $args) {
    $content = file_get_contents(__DIR__.'/../employees.json');
    $employees = json_decode($content);
    $data = [];
    $data['search'] = "";

    if(isset($_POST['search'])) {
        $filterEmployees = [];
        $data['search'] = $_POST['search'];

        //Filter data
        foreach ($employees as $employee) {
            if(stripos($employee->email,$data['search']) !== false)
                $filterEmployees[] = $employee;
        }
        $data['employees'] = $filterEmployees;
    }

    else
        $data['employees'] = $employees;

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $data);
})->setName('emp.grid');

$app->get('/view/{id}', function ($request, $response, $args) {
    $content = file_get_contents(__DIR__.'/../employees.json');
    $employees = json_decode($content);

    // Render view view
    return $this->renderer->render($response, 'view.phtml', ['employees' => $employees,'id' => $args['id']]);
})->setName("emp.view");

$app->get('/service/xml/{min}/{max}', function ($request, $response, $args) {
    $content = file_get_contents(__DIR__.'/../employees.json');
    $employees = json_decode($content);
    $data = [];

    if(isset($args['min'],$args['max'])) {
        $filterEmployees = [];
        $salMin = doubleval($args['min']);
        $salMax = doubleval($args['max']);

        //Filter data
        foreach ($employees as $employee) {
            $cleanSalary = str_replace('$','',$employee->salary);
            $cleanSalary = str_replace(',','',$cleanSalary);
            $salary = doubleval($cleanSalary);
            if($salMin <= $salary && $salary <= $salMax)
                $filterEmployees[] = $employee;
        }
        $data['employees'] = $filterEmployees;
    }

    else
        $data['employees'] = $employees;

    // Render view view
    return $this->renderer->render($response->withHeader('Content-Type','text/xml;charset=UTF-8'), 'xml.phtml', $data);
})->setName('emp.xml');