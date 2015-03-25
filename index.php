<?php

    chdir(dirname(__FILE__));

    require_once 'config/start.php';

    $infomaniak = new application();

    // Load Backup Data if they exist

    $backup_files = array();

    if ($handle = opendir(config::get('paths/base_path') . config::get('paths/save'))) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {
                $backup_files[] = $entry;
            }

        }

        closedir($handle);
    }

    $backup_file = config::get('paths/base_path') . config::get('paths/save') . $backup_files[max(array_keys($backup_files))];

    $infomaniak->load_file($backup_file);

    $print = '<h1>Campus List</h1>';

    foreach ($infomaniak->get_campus_list() AS $campus) {

        $print .= '<div class="campus"><h2>' . $campus->get_city() . '</h2>';

        $print .= '<ul><li>Area: ' . $campus->get_area() . '</li><li>Capacity: ' . $campus->get_capacity() . '</li></ul>';

        $print .= '<h3>Students list:</h3>';

        $print .= '<table><tr><th>First Name</th><th>Last Name</th><th>Id</th></tr>';

        foreach ($campus->get_students() AS $student) {

            $print .= '<tr>
                <td>' . $student->get_first_name() . '</td>
                <td>' . $student->get_last_name() . '</td>
                <td>' . $student->get_id() . '</td>
            </tr>';

        }

        $print .= '</table>';


        $print .= '<h3>Teachers list:</h3>';
        $print .= '<table><tr><th>First Name</th><th>Last Name</th><th>Id</th><th>Type</th><th>Salary</th></tr>';

        foreach ($campus->get_teachers() AS $teacher) {

            $type = $teacher->get_type() == teacher::EXTERNAL ? 'External' : 'Internal';

            $print .= '<tr>
                <td>' . $teacher->get_first_name() . '</td>
                <td>' . $teacher->get_last_name() . '</td>
                <td>' . $teacher->get_id() . '</td>
                <td>' . $type . '</td>
                <td>' . $teacher->get_salary() . '</td>
            </tr>';

        }

        $print .= '</table>';

        $print .= '</div>';

    }

    echo $print;


