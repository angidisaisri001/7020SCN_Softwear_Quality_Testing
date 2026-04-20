<?php
class ApiController extends Controller {
    public function doctors($dept_id) {
        $hospital = $this->model('Hospital');
        echo json_encode($hospital->getDoctorsByDepartment($dept_id));
    }

    public function slots($doctor_id, $date) {
        $hospital = $this->model('Hospital');
        echo json_encode($hospital->getAvailableSlots($doctor_id, $date));
    }
}