<?php
class AdminController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            $this->redirect('auth/login');
        }
    }

    public function dashboard()
    {
        $appModel = $this->model('Appointment');
        $hospitalModel = $this->model('Hospital');
        $userModel = $this->model('User');

        $appointments = $appModel->getAllAppointments();
        $doctors = $hospitalModel->getAllDoctors();
        $patients = $userModel->getAllPatients();
        $departments = $hospitalModel->getDepartments();
        $slots = $hospitalModel->getUpcomingSlots();
        $slotsExistToday = $hospitalModel->checkSlotsExistForToday();

        $this->view('admin/dashboard', [
            'appointments' => $appointments,
            'doctors' => $doctors,
            'patients' => $patients,
            'departments' => $departments,
            'slots' => $slots,
            'slotsExistToday' => $slotsExistToday
        ]);
    }

    public function add_doctor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hospital = $this->model('Hospital');
            $hospital->addDoctor($_POST['name'], $_POST['department_id']);
            $this->redirect('admin/dashboard');
        }
    }

    public function update_appointment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['appointment_id'];
            $status = $_POST['status'];
            $room = $_POST['room_number'];
            $filename = null;

            if ($status == 'completed' && isset($_FILES['prescription']) && $_FILES['prescription']['error'] == 0) {
                $ext = pathinfo($_FILES['prescription']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['prescription']['tmp_name'], 'uploads/' . $filename);
            }

            $appModel = $this->model('Appointment');
            $appModel->updateStatus($id, $status, $room, $filename);
            $this->redirect('admin/dashboard');
        }
    }

    public function generate_roster()
    {
        $hospital = $this->model('Hospital');
        $hospital->generateSlots();
        $this->redirect('admin/dashboard');
    }
    
    public function download($id) {
        $appModel = $this->model('Appointment');
        $appointment = $appModel->getAppointmentById($id);
        
        if ($appointment && $appointment['prescription_file']) {
            $filepath = 'uploads/' . $appointment['prescription_file'];
            if (file_exists($filepath)) {
                $ext = pathinfo($filepath, PATHINFO_EXTENSION);
                $contentType = $ext === 'pdf' ? 'application/pdf' : 'image/' . $ext;
                
                header('Content-Type: ' . $contentType);
                header('Content-Disposition: attachment; filename="' . $appointment['prescription_file'] . '"');
                readfile($filepath);
                exit;
            }
        }
        echo "File not found.";
    }
}
