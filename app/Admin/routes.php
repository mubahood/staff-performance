<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {


    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('meetings', MeetingController::class);
    $router->resource('companies', CompanyController::class);
    $router->resource('departments', DepartmentController::class);
    $router->resource('clients', ClientController::class);
    $router->resource('employees', EmployeesController::class);
    $router->resource('admin-roles', AdminRoleController::class);
    $router->resource('projects', ProjectController::class);
    $router->resource('project-sections', ProjectSectionController::class);
    /*     $router->resource('daily-tasks', TaskController::class);
    $router->resource('weekly-tasks', TaskController::class);
    $router->resource('montly-tasks', TaskController::class); */
    $router->resource('tasks-pending', TaskController::class);
    $router->resource('tasks-manage', TaskController::class);
    $router->resource('tasks-completed', TaskController::class);
    $router->resource('tasks', TaskController::class);
    $router->resource('events', EventController::class);
    $router->get('/calendar', 'HomeController@calendar')->name('calendar');
    $router->resource('patients', PatientController::class);
    $router->resource('patient-records', PatientRecordController::class);
    $router->resource('treatment-records', TreatmentRecordController::class);
    $router->resource('treatment-record-items', TreatmentRecordItemController::class);
    $router->resource('reports', ReportModelController::class);
    $router->resource('targets', TargetController::class);
    $router->resource('gens', GenController::class);
});
