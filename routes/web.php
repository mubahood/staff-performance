<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Company;
use App\Models\Gen;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\ReportModel;
use App\Models\Task;
use App\Models\User;
use App\Models\Utils;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;

Route::get('departmental-workplan', function () {

  //  $_GET['id'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $u = User::find($id);
    if ($u == null) {
        die("User not found");
    }
    //set file name to name of department and date (dompdf) 

    $tasks_tot = 0;
    $tasks_not_submited = 0;
    $tasks_submited = 0;
    $tasks_done = 0;
    $tasks_done_late = 0;
    $tasks_missed = 0;
    $tasks_tot = count($u->tasks);
    foreach ($u->tasks as $key => $task) {
        if ($task->manager_submission_status == 'Not Submitted') {
            $tasks_not_submited++;
        } else {
            $tasks_submited++;
            if ($task->manager_submission_status == 'Done') {
                $tasks_done++;
            } else if ($task->manager_submission_status == 'Done Late') {
                $tasks_done_late++;
            } else if ($task->manager_submission_status == 'Not Attended To') {
                $tasks_missed++;
            }
        }
    }

    if ($tasks_submited > 0) {
        $tasks_done .= " (" . round(($tasks_done / $tasks_submited) * 100, 0) . "%)";
        $tasks_done_late .= " (" . round(($tasks_done_late / $tasks_submited) * 100, 0) . "%)";
        $tasks_missed .= " (" . round(($tasks_missed / $tasks_submited) * 100, 0) . "%)";
    }

    if ($tasks_tot > 0) {
        $tasks_not_submited .= " (" . round(($tasks_not_submited / $tasks_tot) * 100, 0) . "%)";
        $tasks_submited .= " (" . round(($tasks_submited / $tasks_tot) * 100, 0) . "%)";
    }




    $title = $u->name . " " . date("Y-m-d H:i:s");
    $file_name = $title . ".pdf";
    $pdf = App::make('dompdf.wrapper', ['enable_remote' => true, 'enable_html5_parser' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);



    $pdf->setPaper('A4', 'portrait');
    $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'open-sans']);
    $pdf->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

    $pdf->loadHTML(view('departmental-workplan', [
        'user' => $u,
        'title' => $title,
        'tasks_tot' => $tasks_tot,
        'tasks_missed' => $tasks_missed,
        'tasks_done_late' => $tasks_done_late,
        'tasks_done' => $tasks_done,
        'tasks_not_submited' => $tasks_not_submited,
        'tasks_submited' => $tasks_submited,
    ])->render());
    return $pdf->stream($file_name);
});

Route::get('report', function () {

    $id = $_GET['id'];
    $item = ReportModel::find($id);
    $pdf = App::make('dompdf.wrapper');
    $pdf->set_option('enable_html5_parser', TRUE);
    $pdf->loadHTML(view('report', [
        'item' => $item,
    ])->render());
    return $pdf->stream('test.pdf');
});

Route::get('employee-report', function () {
    $id = $_GET['id'];
    $company = Company::find($id);
    $pdf = App::make('dompdf.wrapper');
    $pdf->set_option('enable_html5_parser', TRUE);
    $pdf->loadHTML(view('departmental-workplan')->render());
    return $pdf->stream('departmental-workplan.pdf');
});
Route::get('form', function () {
    ///*  */$id = $_GET['id'];
    //$company = Company::find($id);
    $pdf = App::make('dompdf.wrapper');
    $pdf->set_option('enable_html5_parser', TRUE);
    $pdf->loadHTML(view('company-form')->render());
    return $pdf->stream('company-form.pdf');
});





Route::get('project-report', function () {

    $id = $_GET['id'];
    $project = Project::find($id);

    $pdf = App::make('dompdf.wrapper');
    //'isHtml5ParserEnabled', true
    $pdf->set_option('enable_html5_parser', TRUE);


    $pdf->loadHTML(view('project-report', [
        'title' => 'project',
        'item' => $project,
    ])->render());

    return $pdf->stream('file_name.pdf');
});

//return view('mail-1');

Route::get('reset-mail', function () {
    $u = User::find($_GET['id']);
    try {
        $u->send_password_reset();
        die('Email sent');
    } catch (\Throwable $th) {
        die($th->getMessage());
    }
});

Route::get('reset-password', function () {
    $u = User::where([
        'stream_id' => $_GET['token']
    ])->first();
    if ($u == null) {
        die('Invalid token');
    }
    return view('auth.reset-password', ['u' => $u]);
});

Route::post('reset-password', function () {
    $u = User::where([
        'stream_id' => $_GET['token']
    ])->first();
    if ($u == null) {
        die('Invalid token');
    }
    $p1 = $_POST['password'];
    $p2 = $_POST['password_1'];
    if ($p1 != $p2) {
        return back()
            ->withErrors(['password' => 'Passwords do not match.'])
            ->withInput();
    }
    $u->password = bcrypt($p1);
    $u->save();

    return redirect(admin_url('auth/login') . '?message=Password reset successful. Login to continue.');
    if (Auth::attempt([
        'email' => $u->email,
        'password' => $p1,
    ], true)) {
        die();
    }
    return back()
        ->withErrors(['password' => 'Failed to login. Try again.'])
        ->withInput();
});

Route::get('request-password-reset', function () {
    return view('auth.request-password-reset');
});

Route::post('request-password-reset', function (Request $r) {
    $u = User::where('email', $r->username)->first();
    if ($u == null) {
        return back()
            ->withErrors(['username' => 'Email address not found.'])
            ->withInput();
    }
    try {
        $u->send_password_reset();
        $msg = 'Password reset link has been sent to your email ' . $u->email . ".";
        return redirect(admin_url('auth/login') . '?message=' . $msg);
    } catch (\Throwable $th) {
        $msg = $th->getMessage();
        return back()
            ->withErrors(['username' => $msg])
            ->withInput();
    }
});

Route::get('auth/login', function () {
    $u = Admin::user();
    if ($u != null) {
        return redirect(url('/'));
    }

    return view('auth.login');
})->name('login');

Route::get('mobile', function () {
    return url('');
});
Route::get('test', function () {
    $m = Meeting::find(1);
});




Route::get('/gen-form', function () {
    die(Gen::find($_GET['id'])->make_forms());
})->name("gen-form");


Route::get('generate-class', [MainController::class, 'generate_class']);
Route::get('/gen', function () {
    $m = Gen::find($_GET['id']);
    if ($m == null) {
        return "Not found";
    }
    die($m->do_get());
})->name("register");
