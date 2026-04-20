<?php
class Hospital
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getDepartments()
    {
        return $this->db->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctorsByDepartment($dept_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM doctors WHERE department_id = ?");
        $stmt->execute([$dept_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDoctors()
    {
        return $this->db->query("SELECT d.*, dept.name as dept_name FROM doctors d JOIN departments dept ON d.department_id = dept.id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableSlots($doctor_id, $date)
    {
        $stmt = $this->db->prepare("SELECT * FROM slots WHERE doctor_id = ? AND slot_date = ? AND is_booked = 0");
        $stmt->execute([$doctor_id, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generateSlots()
    {
        $departments = $this->getDepartments();
        $startDate = date('Y-m-d');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime("+$i days", strtotime($startDate)));

            foreach ($departments as $dept) {
                $doctors = $this->getDoctorsByDepartment($dept['id']);
                if (empty($doctors)) continue;

                $time = strtotime('09:00:00');

                for ($j = 0; $j < 7; $j++) {
                    $slotTime = date('H:i:s', $time);

                    $randomDoc = $doctors[array_rand($doctors)];

                    $stmt = $this->db->prepare("SELECT id FROM slots WHERE doctor_id = ? AND slot_date = ? AND start_time = ?");
                    $stmt->execute([$randomDoc['id'], $date, $slotTime]);

                    if ($stmt->rowCount() == 0) {
                        $stmtInsert = $this->db->prepare("INSERT INTO slots (doctor_id, slot_date, start_time) VALUES (?, ?, ?)");
                        $stmtInsert->execute([$randomDoc['id'], $date, $slotTime]);
                    }

                    $time = strtotime('+30 minutes', $time);
                }
            }
        }
    }

    public function addDoctor($name, $department_id)
    {
        $stmt = $this->db->prepare("INSERT INTO doctors (name, department_id) VALUES (?, ?)");
        if ($stmt->execute([$name, $department_id])) {
            $newDocId = $this->db->lastInsertId();

            $startDate = date('Y-m-d');
            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', strtotime("+$i days", strtotime($startDate)));
                $time = strtotime('14:00:00');

                for ($j = 0; $j < 3; $j++) {
                    $slotTime = date('H:i:s', $time);
                    $stmtSlot = $this->db->prepare("INSERT INTO slots (doctor_id, slot_date, start_time) VALUES (?, ?, ?)");
                    $stmtSlot->execute([$newDocId, $date, $slotTime]);
                    $time = strtotime('+30 minutes', $time);
                }
            }
            return true;
        }
        return false;
    }

    public function getUpcomingSlots()
    {
        $stmt = $this->db->query("
            SELECT s.*, d.name as doctor_name, dept.name as dept_name, dept.id as dept_id 
            FROM slots s 
            JOIN doctors d ON s.doctor_id = d.id 
            JOIN departments dept ON d.department_id = dept.id
            WHERE s.slot_date >= CURDATE() 
            ORDER BY s.slot_date ASC, s.start_time ASC 
            LIMIT 1500
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkSlotsExistForToday()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM slots WHERE slot_date = CURDATE()");
        return $stmt->fetchColumn() > 0;
    }
}
