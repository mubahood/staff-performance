<?php
if (!isset($tasks_done)) {
    $tasks_done = 0;
}

if (!isset($events_count)) {
    $events_count = 0;
}
if (!isset($project_count)) {
    $project_count = 0;
}
if (!isset($tasks_count)) {
    $tasks_count = 0;
}
?>
{{-- 
    '' => $tasks_missed,
    '' => $tasks_not_submitted,
    --}}<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                @include('widgets.box-6', [
                    'is_dark' => false,
                    'title' => 'Done Tasks',
                    'icon' => 'box',
                    'number' => $tasks_done,
                    'link' => 'javascript:;',
                ])
            </div>
            <div class="col-md-4">
                @include('widgets.box-6', [
                    'is_dark' => false,
                    'title' => 'Not Attended To',
                    'icon' => 'list-task',
                    'number' => $tasks_missed,
                    'link' => 'javascript:;',
                ])
            </div>
            <div class="col-md-4">
                @include('widgets.box-6', [
                    'is_dark' => true,
                    'title' => 'Not Submitted',
                    'icon' => 'calendar-event-fill',
                    'number' => $tasks_not_submitted,
                    'link' => 'javascript:;',
                ])
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @include('dashboard.upcoming-events', [
            'items' => $meetings,
        ])
    </div>
    <div class="col-md-6">
        @include('dashboard.tasks', [
            'items' => $tasks,
        ])
    </div>
</div>
{{-- 
    Comments i have worked on sofar
    1.fixed the eror now (anyone can login with their respective role)
    2.Fixed the dashboard
    3. Fixed the app name on the login screen
    4. corrected the Employee report
    5. when atast is assigned to someone in a meeting it goes directly to their list
    6.changed the favicon
    7.for the Evaluate part (it helps to identify the workers to be tracked)
    8.
    Missing part 
    1.Add button incase the dropdown is empty 
     --}}