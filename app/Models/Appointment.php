<?php
class Appointment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function book($patient_id, $doctor_id, $slot_id, $health_issue)
    {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("SELECT is_booked FROM slots WHERE id = ? FOR UPDATE");
            $stmt->execute([$slot_id]);
            $slot = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($slot['is_booked']) {
                $this->db->rollBack();
                return false;
            }

            $stmt = $this->db->prepare("UPDATE slots SET is_booked = 1 WHERE id = ?");
            $stmt->execute([$slot_id]);

            $stmt = $this->db->prepare("INSERT INTO appointments (patient_id, doctor_id, slot_id, health_issue) VALUES (?, ?, ?, ?)");
            $stmt->execute([$patient_id, $doctor_id, $slot_id, $health_issue]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getPatientAppointments($patient_id)
    {
        $stmt = $this->db->prepare("SELECT a.*, d.name as doctor_name, s.slot_date, s.start_time FROM appointments a JOIN doctors d ON a.doctor_id = d.id JOIN slots s ON a.slot_id = s.id WHERE a.patient_id = ? ORDER BY s.slot_date DESC");
        $stmt->execute([$patient_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAppointments()
    {
        return $this->db->query("SELECT a.*, u.name as patient_name, d.name as doctor_name, s.slot_date, s.start_time FROM appointments a JOIN users u ON a.patient_id = u.id JOIN doctors d ON a.doctor_id = d.id JOIN slots s ON a.slot_id = s.id ORDER BY s.slot_date DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status, $room, $file = null)
    {
        $query = "UPDATE appointments SET status = ?, room_number = ?";
        $params = [$status, $room];
        if ($file) {
            $query .= ", prescription_file = ?";
            $params[] = $file;
        }
        $query .= " WHERE id = ?";
        $params[] = $id;
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function getAppointmentById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM appointments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
