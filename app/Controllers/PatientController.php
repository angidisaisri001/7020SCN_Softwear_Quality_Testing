<?php
class PatientController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
            $this->redirect('auth/login');
        }
    }

    public function dashboard() {
        $appModel = $this->model('Appointment');
        $appointments = $appModel->getPatientAppointments($_SESSION['user_id']);
        $this->view('patient/dashboard', ['appointments' => $appointments]);
    }

    public function book() {
        $hospital = $this->model('Hospital');
        $departments = $hospital->getDepartments();
        $this->view('patient/book', ['departments' => $departments]);
    }

    public function confirm_booking() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $appModel = $this->model('Appointment');
            $appModel->book($_SESSION['user_id'], $_POST['doctor_id'], $_POST['slot_id'], $_POST['health_issue']);
            $this->redirect('patient/dashboard');
        }
    }

    public function download($id) {
        $appModel = $this->model('Appointment');
        $apps = $appModel->getPatientAppointments($_SESSION['user_id']);
        $file = '';
        foreach($apps as $a) {
            if($a['id'] == $id) $file = $a['prescription_file'];
        }
        if($file && file_exists('uploads/' . $file)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.$file.'"');
            readfile('uploads/' . $file);
            exit;
        }
    }
}